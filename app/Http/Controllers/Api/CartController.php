<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CartResource;
use App\Models\Appointment;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Invoice;
use App\Models\Offer;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    protected $lang;

    public function __construct(Request $request)
    {
        $this->lang = $request->header('lang', 'en');
    }
    public function addToCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'offer_id' => 'required|exists:offers,id',
            'doctor_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date_format:Y-m-d|after_or_equal:today',
            // 'appointment_time' => 'required|date_format:H:i',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $baseUrl = getenv('BASE_URL') . 'images/';
            $offer = Offer::where('id', $request->offer_id)->where('is_active', 1)
                ->where('start_date', '<=', now())
                ->where('end_date', '>=', now())->first();
            if (!$offer) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => 'Offer not Exist'
                ], 422);
            }
            if (!$offer->doctor_ids) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => 'No Doctors in this Offer yet'
                ], 422);
            }
            // check if the doctor id is in the offer docor_ids list
            if (!in_array($request->doctor_id, $offer->doctor_ids)) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => 'Offer not Exist'
                ], 422);
            }
            $doctor = User::where('id', $request->doctor_id)->where('user_type', User::DOCTOR)->first();
            if (!$doctor) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => 'Doctor not Exist'
                ], 422);
            }

            $appointment_time = NULL;
            if ($doctor->hospital && $doctor->hospital->appointment_with_time) {
                if (!$request->appointment_time) {
                    return response()->json([
                        'message' => 'Validation failed',
                        'errors' => 'Appointment time is required'
                    ], 422);
                }
                $isExist = Appointment::where([
                    'appointment_date' => $request->appointment_date,
                    'appointment_time' => $request->appointment_time,
                    'offer_id' => $request->offer_id,
                    'doctor_id' => $request->doctor_id,
                ])->whereIn('status', ['P', 'C'])->first();
                if ($isExist) {
                    return $this->SuccessResponse(200, 'This slot is already booked please try another one', null);
                }
                $appointment_time = $request->appointment_time;
            }


            $setting = Settings::first();
            $user = $request->user();
            $vat = $setting?->vat ?? 0.0;
            if ($user->id_number) {
                $first_digit = substr($user->id_number, 0, 1);
                if ($first_digit == '1') {
                    $vat = 0.0;
                }
            }

            $a = new Appointment();
            $a->offer_id = $request->offer_id;
            $a->doctor_id = $request->doctor_id;
            $a->patient_id = $user->id;
            $a->hospital_id = $offer->hospital_id;
            $a->appointment_date = $request->appointment_date;
            $a->appointment_time = $appointment_time;
            $a->appointment_type = $request->appointment_type;
            $a->booking_for = $request->booking_for;
            $a->concern = $request->concern;
            $a->status = "P";
            $a->description = $request->description;
            $a->fee = $offer->price;
            $a->vat = $vat;
            $a->save();

            // Create cart if not exists
            $cart = Cart::firstOrCreate([
                'user_id' => $user->id,
                'is_paid' => false,
            ]);
            // Add item
            $total = $a->fee + ($a->fee * $vat / 100);
            $cart->items()->create([
                'appointment_id' => $a->id,
                'price' => $a->fee,
                'vat' => $vat,
                'total' => $total,
            ]);
            // Update total
            $cart->total = $cart->items->sum(fn($i) => $i->total);
            $cart->save();

            // Create invoice after appointment is saved
            $invoice = Invoice::where(
                [
                    'cart_id'          => $cart->id,
                    'patient_id'       => $user->id,
                    'paymentstatus'    => 'Pending',
                ]
            )->first();
            if (!$invoice) {
                $invoice = new Invoice();
                $invoice->cart_id = $cart->id;
                $invoice->patient_id = $user->id;
                $invoice->paymentstatus = 'Pending';
                $invoice->invoice_number = 'INV' . str_pad($a->id, 6, '0', STR_PAD_LEFT);
                $invoice->company_name = $setting?->website_name ?? '';
                $invoice->company_address = $setting?->address_line_1 ?? '';
                $invoice->invoice_date = now();
                $invoice->tax_number = $setting?->tax_number;
                $invoice->subtotal = $cart->items->sum(fn($i) => $i->price);
                $invoice->vat = $vat;
                $invoice->save();
            } else {
                // update offer_id and doctor_id in case they changed
                $invoice->subtotal = $cart->items->sum(fn($i) => $i->price);
                $invoice->save();
            }
            return $this->SuccessResponse(200, 'Appointment Added to cart successfully', null);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }

    // API fro All Specialities (Done with Lang)
    public function cart()
    {
        try {
            $cart = Cart::with('items.appointment')
                ->where('user_id', auth()->id())
                ->where('is_paid', false)
                ->first();
            $cart = $cart ? CartResource::make($cart) : $cart;
            return $this->SuccessResponse(200, 'Cart reterieved successfully', $cart);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }

    public function removeFromCart($itemId)
    {
        try {
            $item = CartItem::findOrFail($itemId);
            $cart = $item->cart;
            // check is the cart is done paied or not
            if ($cart->is_paid) {
                return $this->ErrorResponse(400, 'Cannot remove item from a paid cart');
            }
            $appointment = $item->appointment;
            // delete appointment
            $appointment->delete();
            // delete cart item
            $item->delete();
            $cart->total = $cart->items->sum(fn($i) => $i->total);
            $cart->save();
            // update invoice total if exists
            $invoice = Invoice::where('cart_id', $cart->id)->first();
            if ($invoice) {
                $invoice->subtotal = $cart->items->sum(fn($i) => $i->price);
                $invoice->save();
            }
            $cart = $cart->load('items.appointment');
            $cart = $cart ? CartResource::make($cart) : $cart;
            return $this->SuccessResponse(200, 'Item removed from cart successfully', $cart);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }
}
