<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\PaytabsService;
use App\Models\Appointment;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    protected $paytabs;

    public function __construct(PaytabsService $paytabs)
    {
        $this->paytabs = $paytabs;
    }

    /**
     * Initiate payment (mobile and web both call this).
     * Request expects: appointment_id, amount, currency (optional)
     */
    public function initiate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'appointment_id' => 'required|exists:appointments,id',
            // 'amount' => 'required|numeric|min:0.1',
            'currency' => 'nullable|string|size:3',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => 422]);
        }
        $data = $request->all();
        $invoice = Invoice::where('appointment_id', $data['appointment_id'])->first();
        if (!$invoice) {
            return response()->json([
            'success' => false,
            'message' => 'Invoice not found for the given appointment.',
            ], 404);
        }

        // Check appointment status and invoice payment info
        $appointment = $invoice->appointment;
        $hasNoPayment = empty($invoice->payment_id) && empty($invoice->paid_at) && strtolower($invoice->paymentstatus) === 'pending';
        $noPaymentRecord = Payment::where('invoice_id', $invoice->id)->doesntExist();

        if (
            !$appointment ||
            $appointment->status !== 'P' ||
            !$hasNoPayment ||
            !$noPaymentRecord
        ) {
            // Return error if invoice is not pending, or has payment_id/paid_at,
            // or appointment is not pending, or payment record exists for this invoice
            return response()->json([
                'success' => false,
                'message' => 'Cannot initiate payment: invoice or appointment not pending, or payment already exists.',
            ], 400);
        }
        $vat_amount = ($invoice->subtotal * $invoice->vat) / 100;
        $total = $invoice->subtotal + $vat_amount;
        DB::beginTransaction();
        try {
            $merchantRef = $this->paytabs->generateMerchantReference('APP');

            $payment = Payment::create([
                'user_id' => $request->user()->id ?? $invoice->user_id,
                'invoice_id' => $invoice->id,
                'merchant_reference' => $merchantRef,
                'amount' => $total,
                'currency' => $data['currency'] ?? 'SAR',
                'status' => 'initiated',
            ]);

            // prepare payload for PayTabs (fields according to PayTabs docs)
            $payload = [
                'profile_id' => env('PAYTABS_PROFILE_ID'),
                'tran_type' => 'sale',
                'tran_class' => 'ecom',
                'cart_id' => $merchantRef, // Visible to user
                'cart_description' => "Appointment with Dr. {$invoice->doctor->name} on {$invoice->invoice_date}", // Visible text
                'cart_currency' => $payment->currency,
                'cart_amount' => (float) $payment->amount,
                "invoice" => [
                    "lang" => "ar",
                    'total' => (float) $payment->amount,
                    "line_items" => [
                        [
                            "description" => "استشاره طبية",
                            "unit_cost" => (float) $invoice->subtotal,
                            "quantity" => 1,
                            "tax_total" =>  $vat_amount,
                            "total" => (float) $payment->amount,
                        ]
                    ]
                ],
                // return and callback URLs:
                'return' => route('api.payments.return'),    // browser redirect after payment
                'callback' => route('api.payments.webhook'),  // server to server (IPN)
                'paypage_lang' => 'ar',
                'payment_methods' => ['all'],
                'hide_shipping' => true,
                'customer_details' => [
                    'name' => $payment->user->name ?? 'Guest',
                    'email' => $payment->user->email ?? ($request->user()->email ?? null),
                    'phone' => $payment->user->mobile ?? ($request->user()->mobile ?? null),
                    "street1" => $payment->user->address ?? ($request->user()->address ?? "null"),
                    "city" => $payment->user->city?->name ?? ($request->user()->city?->name ?? ""),
                    "state" => $payment->user->state?->name ?? ($request->user()->state?->name ?? ""),
                    "country" => $payment->user->country?->code ?? ($request->user()->country?->code ?? 'SA'),
                    "zip" => $payment->user->zip ?? ($request->user()->zip ?? ""),
                ],
            ];

            $result = $this->paytabs->createPaymentPage($payload);

            if (!$result['success']) {
                // store error on payment and rollback
                // $payment->update([
                //     'status' => 'error',
                //     // 'notes' => 'Failed to create pay page: '.$result['body'],
                //     'response_payload' => ['error' => $result],
                // ]);
                // DB::commit(); // still commit so record exists
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to initiate payment',
                    'detail' => $result,
                ], 500);
            }

            $body = $result['body'];
            // PayTabs returns an object with a field containing the redirect URL (varies by API version)
            // We attempt to extract it sanitely; adapt keys to your PayTabs API version.
            $paymentPageUrl = $body['invoice_link'] ?? $body['payment_url'] ?? $body['payment_page_url'] ?? ($body['redirect_url'] ?? null);
            $paytabs_invoice_id = $body['invoice']['id'] ?? null;

            $payment->update([
                'payment_page_url' => $paymentPageUrl,
                'response_payload' => $body,
                'paytabs_invoice_id' => $paytabs_invoice_id,
                'status' => 'pending',
            ]);

            $invoice->update([
                'payment_link' => $paymentPageUrl,
                'payment_id' => $payment->id,
                'paymentstatus' => 'pending',
                'invoice_number' => $paytabs_invoice_id ?? $invoice->invoice_number,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'payment_id' => $payment->id,
                'payment_page_url' => $paymentPageUrl,
                'payload' => $body,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment initiate error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            throw $e; // or return JSON error
        }
    }

    /**
     * IPN / webhook (server-to-server). PayTabs will POST full transaction details to this URL.
     * We must verify the HMAC signature header and update our payment state.
     */
    public function webhook2(Request $request)
    {
        // raw body
        $raw = $request->getContent();
        $signature = $request->header('Signature') ?? $request->header('signature');

        if (!$this->paytabs->verifySignature($raw, $signature)) {
            Log::warning('PayTabs webhook signature verification failed.', [
                'signature_header' => $signature,
                'body' => $raw,
            ]);
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $payload = $request->json()->all();

        // Basic safe update logic:
        $merchantRef = $payload['cart_id'] ?? $payload['merchant_reference'] ?? ($payload['cart_id'] ?? null);
        $transactionId = $payload['transaction_id'] ?? $payload['tran_ref'] ?? $payload['payment_reference'] ?? null;
        $status = strtolower($payload['transaction_status'] ?? $payload['status'] ?? $payload['tran_status'] ?? 'unknown');

        // find by merchant_reference or use user_defined.payment_id
        $payment = null;
        if (!empty($merchantRef)) {
            $payment = Payment::where('merchant_reference', $merchantRef)->first();
        }

        if (!$payment && !empty($payload['user_defined']['payment_id'] ?? null)) {
            $payment = Payment::find($payload['user_defined']['payment_id']);
        }

        if (!$payment) {
            Log::error('PayTabs webhook: Payment record not found.', ['payload' => $payload]);
            return response()->json(['message' => 'Payment not found'], 404);
        }

        // Map statuses (adjust per PayTabs status values)
        $newStatus = $payment->status;
        if (in_array($status, ['completed', 'paid', 'success'])) {
            $newStatus = 'paid';
        } elseif (in_array($status, ['failed', 'declined', 'error'])) {
            $newStatus = 'failed';
        } elseif (in_array($status, ['pending', 'initiated'])) {
            $newStatus = 'pending';
        } elseif (in_array($status, ['cancelled'])) {
            $newStatus = 'cancelled';
        }

        $payment->update([
            'paytabs_transaction_id' => $transactionId,
            'status' => $newStatus,
            'response_payload' => $payload,
            'paid_at' => $newStatus === 'paid' ? now() : $payment->paid_at,
        ]);

        // App-specific: mark appointment paid if paid
        if ($newStatus === 'paid' && $payment->appointment) {
            $payment->appointment->update(['paid' => true, 'status' => 'confirmed']);
            // send notifications, emails, generate invoice, etc. (implement as needed)
        }

        // return 200 OK so PayTabs knows we received it
        return response()->json(['message' => 'OK']);
    }

    public function webhook(Request $request)
    {
        $payload = $request->all();

        Log::info('PayTabs Webhook:', $payload);

        $invoice_id = $payload['invoice_id'] ?? null;
        if (!$invoice_id) {
            return response()->json(['success' => false, 'message' => 'Invalid webhook payload'], 400);
        }

        $payment = Payment::where('paytabs_invoice_id', $invoice_id)->first();
        if (!$payment) {
            return response()->json(['success' => false, 'message' => 'Payment not found'], 404);
        }

        $status = strtolower($payload['payment_result']['response_status']);

        if ($status == 'a') {
            $payment->update([
                'status' => 'paid',
                'paid_at' => $payload['payment_result']['transaction_time'] ?? now(),
                'response_payload' => $payload,
                'paytabs_transaction_id' => $payload['tran_ref'],
            ]);
            if ($payment->invoice) {
                $payment->invoice->update([
                    'paymentstatus' => 'paid',
                    'paid_at' => $payload['payment_result']['transaction_time'] ?? now(),
                ]);
                if ($payment->invoice->appointment) {
                    $payment->invoice->appointment->update([
                        'payment_status' => 'Paid',
                        'payment_date' => $payload['payment_result']['transaction_time'] ?? now(),
                        'status' => 'C',
                    ]);
                }
            }
        } elseif ($status == 'c') {
            $payment->update([
                'status' => 'cancelled',
                'paid_at' => $payload['payment_result']['transaction_time'] ?? now(),
                'response_payload' => $payload,
                'paytabs_transaction_id' => $payload['tran_ref'],
            ]);
            if ($payment->invoice) {
                $payment->invoice->update([
                    'paymentstatus' => 'cancelled',
                    'paid_at' => $payload['payment_result']['transaction_time'] ?? now(),
                ]);
                if ($payment->invoice->appointment) {
                    $test = $payment->invoice->appointment->update([
                        'payment_date' => $payload['payment_result']['transaction_time'] ?? now(),
                        'status' => 'D',
                    ]);
                }
            }
            // Optionally: cancel the invoice in PayTabs system
            $this->paytabs->cancelInvoice($payment->paytabs_invoice_id);
        } else {
            $payment->update([
                'status' => 'failed',
                'paid_at' => $payload['payment_result']['transaction_time'] ?? now(),
                'response_payload' => $payload,
                'paytabs_transaction_id' => $payload['tran_ref'],
            ]);
            if ($payment->invoice) {
                $payment->invoice->update([
                    'paymentstatus' => 'failed',
                    'paid_at' => $payload['payment_result']['transaction_time'] ?? now(),
                ]);
                if ($payment->invoice->appointment) {
                    $payment->invoice->appointment->update([
                        'payment_status' => 'failed',
                        'payment_date' => $payload['payment_result']['transaction_time'] ?? now(),
                        'status' => 'D',
                    ]);
                }
            }
            // Optionally: cancel the invoice in PayTabs system
            $this->paytabs->cancelInvoice($payment->paytabs_invoice_id);
        }


        return response()->json(['success' => true]);
    }


    /**
     * Return URL: where PayTabs redirects the user's browser after payment.
     * This receives a POST (or GET) with a limited payload. We still verify signature if provided.
     */
    public function return2(Request $request)
    {
        $raw = $request->getContent();
        $signature = $request->header('Signature') ?? $request->input('signature') ?? $request->input('Signature');

        if (!$this->paytabs->verifySignature($raw, $signature)) {
            // Some PayTabs versions provide query param signature; if signature absent, perform best-effort
            Log::info('PayTabs return: signature missing or failed; continuing with caution.');
        }

        $payload = $request->all();

        // find payment via cart_id or user_defined.payment_id
        $merchantRef = $payload['cart_id'] ?? ($payload['merchant_reference'] ?? null);
        $payment = null;
        if ($merchantRef) {
            $payment = Payment::where('merchant_reference', $merchantRef)->first();
        }
        if (!$payment && $payload['user_defined']['payment_id'] ?? null) {
            $payment = Payment::find($payload['user_defined']['payment_id']);
        }

        if (!$payment) {
            // show friendly page for web; for api/mobile you might want to return json
            return response()->json(['message' => 'Payment not found'], 404);
        }

        // Optionally: check status and show success/fail page
        $status = strtolower($payload['transaction_status'] ?? $payload['status'] ?? 'unknown');
        if (in_array($status, ['completed', 'paid', 'success'])) {
            $payment->update([
                'status' => 'paid',
                'response_payload' => $payload,
                'paid_at' => now(),
            ]);
            if ($payment->appointment) {
                $payment->appointment->update(['paid' => true, 'status' => 'confirmed']);
            }
            // Redirect to appointment success page in web set-up:
            return redirect()->to(config('app.url') . '/appointments/' . $payment->appointment_id . '?payment=success');
        } else {
            $payment->update([
                'status' => 'failed',
                'response_payload' => $payload,
            ]);
            return redirect()->to(config('app.url') . '/appointments/' . $payment->appointment_id . '?payment=failed');
        }
    }

    public function return(Request $request)
    {
        $payload = $request->all();

        Log::info('PayTabs Return Payload:', $payload);

        $merchantRef = $payload['cartId'] ?? null;
        if (!$merchantRef) {
            return response()->json(['success' => false, 'message' => 'Invalid return payload'], 400);
        }

        // Find payment by merchant reference
        $payment = Payment::where('merchant_reference', $merchantRef)->first();
        if (!$payment) {
            return response()->json(['success' => false, 'message' => 'Payment not found'], 404);
        }

        $status = strtolower($payload['respStatus'] ?? $payload['status'] ?? 'unknown');

        if ($status == 'a') {
            return response()->json([
            'success' => true,
            'message' => 'Payment successful. Appointment confirmed.',
            ]);
        } elseif ($status == 'c') {
            return response()->json([
            'success' => false,
            'message' => 'Payment cancelled. Appointment is cancelled.',
            ]);
        } else {
            return response()->json([
            'success' => false,
            'message' => 'Payment failed. Appointment is cancelled.',
            ]);
        }
    }


    public function show2($id)
    {
        $payment = Payment::with('appointment', 'user')->findOrFail($id);
        return response()->json(['data' => $payment]);
    }

    public function show($id)
    {
        $payment = Payment::findOrFail($id);

        return response()->json([
            'success' => true,
            'payment' => $payment,
        ]);
    }
}
