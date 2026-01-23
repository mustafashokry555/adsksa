<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Offer;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Http\Resources\Api\AppointmentResource;
use App\Models\Invoice;
use App\Models\Notification;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OfferAppointController extends Controller
{
    // public function get_availability(Request $request, $id)
    // {
    //     $offer = Offer::where('id', $id)
    //         ->where('is_active', 1)
    //         ->where('start_date', '<=', now())
    //         ->where('end_date', '>=', now())->first();
    //     if (!$offer) {
    //         return $this->ErrorResponse(404, 'Offer not found', null);
    //     }
    //     $offer->load("regularAvailabilities", "unavailailities");

    //     // Create selected CarbonDate instance
    //     $selectedDate = CarbonImmutable::parse($request->date);
    //     // create date
    //     $date = $selectedDate->format("Y-m-d");
    //     // day of the week
    //     $day_name = strtolower($selectedDate->format("l"));

    //     // Doctor set unavailabilty on a specific date
    //     $unavailability = $offer->unavailailities()->where("date", $date)->first();
    //     // return Not available
    //     if ($unavailability) {

    //         return $this->SuccessResponse(200, "Not Available", []);
    //     }
    //     // Check if doctor set One time appointment on a specific date
    //     $availability = null;
    //     $regularAvailability = $offer->regularAvailabilities()->where("week_day", $day_name)->first();
    //     if ($regularAvailability) {
    //         // Get time intervals to create slots
    //         // $time_interval = $regularAvailability->time_interval ? $regularAvailability->time_interval : 15;
    //         $availability = $regularAvailability;
    //     }
    //     // return $availability;
    //     // if availability is null
    //     if (!$availability) {
    //         return $this->SuccessResponse(200, "Not Available", []);
    //     }
    //     // Appointments of selected date
    //     $appointments = Appointment::where('appointment_date', $date)
    //         ->where('offer_id', $offer->id)
    //         ->whereIn('status', ['P', 'C'])->pluck("appointment_time");

    //     // Creating Slots
    //     $slots = [];
    //     $filteredSlots = collect([]);
    //     $intervals = collect($availability->slots);


    //     // Fliter slots
    //     foreach ($intervals as  $interval) {
    //         $start_dt = $date . $interval["start_time"];
    //         $end_dt = $date . $interval["end_time"];

    //         // Create Slots
    //         $slots = CarbonPeriod::create($start_dt, $availability->time_interval . ' minutes', $end_dt);
    //         foreach ($slots as $slot) {
    //             if ($slot->greaterThan(Carbon::now()->addMinutes(20)) && $slot->lessThan($end_dt)) {
    //                 if (!$appointments->contains($slot->format("H:i:s"))) {
    //                     $filteredSlots->push($slot->format("H:i"));
    //                 }
    //             }
    //         }
    //     }
    //     // return $filteredSlots;
    //     return $this->SuccessResponse(200, 'Available slots', $filteredSlots->unique()->values()->all());
    // }


    // Book New Appointmentneed need alot of updates
    public function BookAppointment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'offer_id' => 'required|exists:offers,id',
            'doctor_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date_format:Y-m-d|after_or_equal:today',
            'appointment_time' => 'required|date_format:H:i',
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
            $doctor = User::where('id', $request->doctor_id)->first();
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
            $a->patient_id = $request->user()->id;
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

            // Create invoice after appointment is saved
            $invoice = Invoice::create([
                'appointment_id'   => $a->id,
                'offer_id'         => $a->offer_id,
                'patient_id'       => $a->patient_id,
                'hospital_id'      => $a->hospital_id,
                'invoice_number'   => 'INV' . str_pad($a->id, 6, '0', STR_PAD_LEFT),
                'company_name'     => $setting?->website_name ?? '',
                'company_address'  => $setting?->address_line_1 ?? '',
                'invoice_date'     => now(),
                'tax_number'       => $setting?->tax_number,
                'subtotal'         => $a->fee,
                'vat'              => $vat,
                'paymentstatus'    => 'Pending',
            ]);
            Notification::create([
                'from_id' => $a->patient_id,
                'to_id' => $a->hospital->hospitalAdmin->id,
                'title_en' => "New Appointment",
                'title_ar' => "ميعاد جديد",
                'notifiable_id' => $a->id,
                'notifiable_type' => Appointment::class,
                'message_ar' => 'تم اضافه ميعاد (#' . $a->id . ') في انتظار الموافقة',
                'message_en' => 'New Appointment (#' . $a->id . ') is waiting for approval',
            ]);

            $appointment = Appointment::where('appointments.patient_id', $request->user()->id)
                ->where('appointments.id', $a->id)
                ->join('offers', 'offers.id', 'appointments.offer_id')
                ->join('users as patientuser', 'patientuser.id', 'appointments.patient_id')
                ->join('hospitals', 'hospitals.id', 'appointments.hospital_id')
                ->select(
                    'appointments.id',
                    'appointments.offer_id',
                    DB::raw("IFNULL(offers.title_{$this->getLang()}, offers.title_en) as offer_title"),
                    'hospitals.id as hospital_id',
                    DB::raw("IFNULL(hospitals.hospital_name_{$this->getLang()}, hospitals.hospital_name_en) as hospital_name"),
                    'appointments.appointment_date',
                    'appointments.appointment_time',
                )
                ->first();

            return $this->SuccessResponse(200, 'Appointment details', $appointment);
        } catch (\Throwable $th) {

            return $this->ErrorResponse(400, $th->getMessage());
        }
    }
    // cancel the appointment
    public function CancelAppointment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'appointment_id' => 'required',
            'integer',
            'cancel_reason' => 'nullable',
            'string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $appointment = Appointment::where('patient_id', $request->user()->id)
            ->where('id', $request->appointment_id)->first();
        if (!$appointment) {
            return $this->ErrorResponse(404, "Appointment not found");
        }
        $appointment->status = 'D';
        $appointment->cancel_reason = $request->cancel_reason;
        $appointment->save();

        Notification::create([
            'from_id' => $appointment->patient_id,
            'to_id' => $appointment->hospital->hospitalAdmin->id,
            'title_en' => "Appointment Canceled",
            'title_ar' => "تم الغاء الميعاد",
            'notifiable_id' => $appointment->id,
            'notifiable_type' => Appointment::class,
            'message_ar' => 'تم حذف المعاد (#' . $appointment->id . ') بواسطه المريض',
            'message_en' => 'Appointment (#' . $appointment->id . ') Has Been Canceled By Patient'
        ]);
        return $this->SuccessResponse(200, "Appointment cancelled", null);
    }
}
