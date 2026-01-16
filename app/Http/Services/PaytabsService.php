<?php

namespace App\Http\Services;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Psr\Http\Message\ServerRequestInterface;

class PaytabsService
{
    protected $profileId;
    protected $serverKey;
    protected $clientKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->profileId = config('services.paytabs.profile_id') ?? env('PAYTABS_PROFILE_ID');
        $this->serverKey = config('services.paytabs.server_key') ?? env('PAYTABS_SERVER_KEY');
        $this->clientKey  = config('services.paytabs.client_key') ?? env('PAYTABS_CLIENT_KEY');
        $this->baseUrl = rtrim(config('services.paytabs.base_url') ?? env('PAYTABS_BASE_URL', 'https://api.paytabs.com'), '/');
    }

    /**
     * Create a merchant reference string
     */
    public function generateMerchantReference($prefix = 'APP')
    {
        return strtoupper($prefix . '_' . Str::random(8) . '_' . time());
    }

    /**
     * Create hosted payment page (returns array with payment_page_url and full response)
     * This uses PayTabs' "create pay page / payment page" API — exact endpoint may differ per account/version.
     */
    public function createPaymentPage(array $payload): array
    {
        // set auth header
        $url = $this->baseUrl . '/payment/request'; // keep configurable; adjust per PayTabs docs if necessary

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $this->serverKey,
        ];

        // example: using Laravel HTTP client
        $response = Http::withHeaders($headers)
            ->timeout(30)
            ->post($url, $payload);

        if ($response->failed()) {
            return [
                'success' => false,
                'status' => $response->status(),
                'body' => $response->body(),
            ];
        }

        return [
            'success' => true,
            'status' => $response->status(),
            'body' => $response->json(),
        ];
    }

    // cancel invoice
    public function cancelInvoice($invoiceId): array
    {
        $url = $this->baseUrl . '/payment/invoice/cancel'; // adjust per PayTabs docs if necessary

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $this->serverKey,
        ];

        $payload = [
            'invoice_id' => $invoiceId,
            'profile_id' => $this->profileId,
        ];

        $response = Http::withHeaders($headers)
            ->timeout(30)
            ->post($url, $payload);

        if ($response->failed()) {
            return [
                'success' => false,
                'status' => $response->status(),
                'body' => $response->body(),
            ];
        }

        return [
            'success' => true,
            'status' => $response->status(),
            'body' => $response->json(),
        ];
    }

    public function initiate($appointment_id, $currency = 'SAR')
    {
        $invoice = Invoice::where('appointment_id', $appointment_id)->first();
        if (!$invoice) {
            return [
            'success' => false,
            'message' => 'Invoice not found for the given appointment.',
            ];
        }

        // Check appointment status and invoice payment info
        $appointment = $invoice->appointment;
        $hasNoPayment = empty($invoice->paid_at) && strtolower($invoice->paymentstatus) === 'pending';
        // $noPaymentRecord = Payment::where('invoice_id', $invoice->id)->doesntExist();

        if (
            !$appointment ||
            $appointment->status !== 'P' ||
            !$hasNoPayment
            // !$noPaymentRecord
        ) {
            // Return error if invoice is not pending, or has payment_id/paid_at,
            // or appointment is not pending, or payment record exists for this invoice
            return [
                'success' => false,
                'message' => 'Cannot initiate payment: invoice or appointment not pending, or payment already exists.',
            ];
        }
        $vat_amount = ($invoice->subtotal * $invoice->vat) / 100;
        $total = $invoice->subtotal + $vat_amount;
        DB::beginTransaction();
        try {
            $merchantRef = $this->generateMerchantReference('WEB');
            $user = Auth::user();
            $payment = Payment::create([
                'user_id' => $user?->id ?? $invoice->user_id,
                'invoice_id' => $invoice->id,
                'merchant_reference' => $merchantRef,
                'amount' => $total,
                'currency' => $currency ?? 'SAR',
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
                'return' => route('api.payments.returnWeb'),    // browser redirect after payment
                'callback' => route('api.payments.webhook'),  // server to server (IPN)
                'paypage_lang' => 'ar',
                'payment_methods' => ['all'],
                'hide_shipping' => true,
                'customer_details' => [
                    'name' => $payment->user->name ?? 'Guest',
                    'email' => $payment->user->email ?? ($user?->email ?? null),
                    'phone' => $payment->user->mobile ?? ($user?->mobile ?? null),
                    "street1" => $payment->user->address ?? ($user?->address ?? "null"),
                    "city" => $payment->user->city?->name ?? ($user?->city?->name ?? ""),
                    "state" => $payment->user->state?->name ?? ($user?->state?->name ?? ""),
                    "country" => $payment->user->country?->code ?? ($user?->country?->code ?? 'SA'),
                    "zip" => $payment->user->zip ?? ($user?->zip ?? ""),
                ],
            ];

            $result = $this->createPaymentPage($payload);

            if (!$result['success']) {
                // store error on payment and rollback
                // $payment->update([
                //     'status' => 'error',
                //     // 'notes' => 'Failed to create pay page: '.$result['body'],
                //     'response_payload' => ['error' => $result],
                // ]);
                // DB::commit(); // still commit so record exists
                return [
                    'success' => false,
                    'message' => 'Failed to initiate payment',
                    'detail' => $result,
                ];
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

            return [
                'success' => true,
                'payment_id' => $payment->id,
                'payment_page_url' => $paymentPageUrl,
                'payload' => $body,
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment initiate error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            throw $e; // or return JSON error
        }
    }
}
