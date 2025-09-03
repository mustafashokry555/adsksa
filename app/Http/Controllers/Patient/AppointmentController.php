<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Invoice;
use App\Models\Notification;
use App\Models\ScheduleSetting;
use App\Models\Review;
use App\Models\User;
use App\Models\Insurance;
use App\Models\Hospital;
use App\Models\Settings;
use App\Models\Speciality;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Unavailability;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use SimpleXMLElement;

class AppointmentController extends Controller
{
    public function create_appointment($id)
    {
        if (Auth::user()->is_patient()) {

            // Example usage:
            //
            $doctor = User::find($id);
            //     $intervals =null;
            //     $time_interval = ScheduleSetting::query()->where('hospital_id', $doctor->hospital_id)->first();

            //     $dayArr = ['sunday'=>[],'monday'=>[],'tuesday'=>[],'wednesday'=>[],'thursday'=>[],'friday'=>[],'saturday'=>[]];
            //     $days = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];

            //     $slotsArr = [];
            //  for($i = 0; $i <=6; $i++){

            //   $intervals=[];
            //   $slots = \App\Models\RegularAvailability::where(['doctor_id'=> $doctor->id,'week_day'=>$days[$i]])->first();
            //   $oneDaysSlots = [];
            //   if($slots){

            //      for($x = 0; $x <count($slots->slots); $x++){
            //       $startTime = $slots->slots[$x]['start_time'];
            //       $endTime = $slots->slots[$x]['end_time'];
            //       $availableSlots = $this->generateTimeSlots($startTime, $endTime,$slots->time_interval)??[];
            //       $oneDaysSlots = array_merge($oneDaysSlots,$availableSlots);

            //      }
            //   }
            //   $slotsArr[$i] = $oneDaysSlots;
            //  }
            //  dd( $slotsArr);


            // for ($i = 0; $i <= 6; $i++) {
            //     if ($doctor->schedules[$i]->from ?? '') {
            //         $starting_time = $doctor->schedules[$i]->from;
            //         $end_time = $doctor->schedules[$i]->to;
            //         if ($time_interval->time_interval ?? '') {
            //             $intervals = CarbonInterval::minutes($time_interval->time_interval)->toPeriod($starting_time, $end_time);
            //         } else {
            //             $intervals = CarbonInterval::minutes(60)->toPeriod($starting_time, $end_time);
            //         }
            //     }
            // }
            // dd( $time_interval);
            // $intervals = $slotsArr;
            // $unavailablities = Unavailability::where('doctor_id',$id)->get();
            $hospital = Hospital::findOrFail($doctor->hospital_id);
            $insurances = $hospital->insurances;


            // if ($intervals ?? '')
            return view('patient.appointment.create', [
                'doctor' => User::find($id),
                // 'intervals' => $intervals,
                // 'date' => today(),
                // 'unavailablities'=>$unavailablities,
                'insurances' => $insurances

            ]);
            // else
            //     return view('patient.appointment.create', [
            //         'doctor' => User::find($id),
            //         'date' => today(),
            //     ]);
        } else {
            abort(401);
        }
    }

    // public function store_appointment(Request $request)
    // {
    //     if (Auth::user()->is_patient()) {

    //         $attributes = $request->validate([
    //             'doctor_id' => 'required',
    //             'patient_id' => 'required',
    //             'hospital_id' => 'required',
    //             'appointment_date' => 'required',
    //             'appointment_time' => 'required',
    //             'status' => 'required'
    //         ]);
    //         Appointment::create($attributes);

    //         return redirect()
    //             ->route('appointments')
    //             ->with('flash', ['type', 'success', 'message' => 'Appointment create Successfully']);
    //     } else {
    //         abort(401);
    //     }
    // }
    public function store_appointment(Request $request)
    {
        $attributes = $request->validate([
            'doctor_id' => 'required',
            'patient_id' => 'required',
            'hospital_id' => 'required',
            // "schedule_date" => ['required', "date"],
            // 'appointment_date' => 'required',
            // 'appointment_time' => 'required',
            "selected_slot" => "required",
            'status' => 'required',
            // 'insurance'=>?
        ], [
            "selected_slot.required" => "Please select a time slot",
        ]);
        // dd($request->all());
        $doctor = User::where('id', $request->doctor_id)->first();
        $dateTime = CarbonImmutable::parse($request->selected_slot);
        // VAT
        // $invoiceSettings = GenralSettings::where('parent', 'invoice')->get();
        // $invoiceSettings = GenralSettings::makeFlat($invoiceSettings);
        $request->merge([
            "appointment_date" => $dateTime->format("Y-m-d"),
            "appointment_time" => $dateTime->format("H:i:s"),
            "fee" => $doctor->pricing,
            "status" => 'P'
            // "insurance_id"=> $insurance
            // "vat" => $invoiceSettings->get("vat", 0.0),
        ]);
        $appointment = Appointment::create($request->except("selected_slot"));
        Notification::create([
            'from_id' => $appointment->patient_id,
            'to_id' => $appointment->doctor_id,
            // 'appointment_id' => $appointment->id,
            'title_en' => "New Appointment",
            'title_ar' => "ميعاد جديد",
            'notifiable_id' => $appointment->id,
            'notifiable_type' => Appointment::class,
            'message_ar' => 'تم اضافه ميعاد (#' . $appointment->id . ') في انتظار الموافقة',
            'message_en' => 'New Appointment (#' . $appointment->id . ') is waiting for approval',
        ]);

        return redirect()
            ->route('appointments')
            ->with('flash', ['type', 'success', 'message' => 'Appointment create Successfully']);
    }
    public function manage_appointments(Request $request)
    {
        if (Auth::user()->is_patient()) {
            return view('patient.appointment.index', [
                'appointments' => Appointment::query()->where('patient_id', Auth::id())->orderByDesc('id')->get(),
            ]);
        } elseif (Auth::user()->is_doctor()) {
            // return view('doctor.appointment.index', [
            //     'appointments' => Appointment::query()->where('doctor_id', Auth::id())->orderByDesc('id')->get(),
            // ]);

            $appointments = Appointment::query()
                ->where('doctor_id', Auth::id())
                ->orderByDesc('id')
                ->paginate(10);
            // dd( $appointments);
            return view('doctor.appointment.index', compact('appointments'));
        } elseif (Auth::user()->is_hospital()) {
            return view('hospital.appointment.index', [
                'appointments' => Appointment::query()->where('hospital_id', Auth::user()->hospital_id)->orderByDesc('id')->get(),
            ]);
        } elseif (Auth::user()->is_admin()) {
            $selectedSpecialities = $request->speciality;
            $specialities = Speciality::all();
            $query = Appointment::query();

            if ($selectedSpecialities) {
                $query->join('users', 'appointments.doctor_id', '=', 'users.id');
                $query->whereIn('users.speciality_id', $selectedSpecialities);
                $query->select('appointments.*');
            }
            $appointments = $query->orderByDesc('appointments.id')->get();

            return view('admin.appointment.index', [
                'appointments' => $appointments,
                'specialities' =>  $specialities

            ]);
        } else {
            abort(401);
        }
    }

    public function update_apt_status(Appointment $appointment)
    {
        $user_type = Auth::user()->user_type;
        if ($appointment = $appointment) {
            $attributes = request()->validate([
                'status' => 'required',
            ]);
            if ($user_type == 'U') {
                $attributes['cancel_by_patient'] = '1';
            }
            $appointment->update($attributes);
        }
        if (request('status') == 'C') {
            // store invoice
            $setting = Settings::first();
            $invoice = Invoice::create([
                'appointment_id'   => $appointment->id,
                'doctor_id'        => $appointment->doctor_id,
                'patient_id'       => $appointment->patient_id,
                'hospital_id'      => $appointment->hospital_id,
                'invoice_number'   => 'INV' . str_pad($appointment->id, 6, '0', STR_PAD_LEFT),
                'company_address'  => $setting?->address_line_1 ?? '',
                'company_name'     => $setting?->website_name ?? '',
                'invoice_date'     => now(),
                'tax_number'       => $setting?->tax_number,
                'subtotal'         => $appointment->fee,
                'vat'              => $setting?->vat ?? 0.0,
            ]);
            Notification::create([
                'from_id' => $appointment->doctor_id,
                'to_id' => $appointment->patient_id,
                // 'appointment_id' => $appointment->id,
                'title_en' => "Appointment Confirmed",
                'title_ar' => "تم تأكيد الميعاد",
                'notifiable_id' => $appointment->id,
                'notifiable_type' => Appointment::class,
                'message_ar' => 'تم تأكيد المعاد (#' . $appointment->id . ')',
                'message_en' => 'Appointment (#' . $appointment->id . ') Has Been Confirmed'
            ]);
            return redirect()
                ->route('appointments')
                ->with('flash', ['type', 'success', 'message' => 'Appointment Confirmed']);
        } elseif (request('status') == 'D') {
            switch ($user_type) {
                case 'U':
                    Notification::create([
                        'from_id' => $appointment->patient_id,
                        'to_id' => $appointment->doctor_id,
                        // 'appointment_id' => $appointment->id,
                        'title_en' => "Appointment Canceled",
                        'title_ar' => "تم الغاء الميعاد",
                        'notifiable_id' => $appointment->id,
                        'notifiable_type' => Appointment::class,
                        'message_ar' => 'تم حذف المعاد (#' . $appointment->id . ') بواسطه المريض',
                        'message_en' => 'Appointment (#' . $appointment->id . ') Has Been Canceled By Patient'
                    ]);
                    break;

                case 'D':
                    Notification::create([
                        'from_id' => $appointment->doctor_id,
                        'to_id' => $appointment->patient_id,
                        // 'appointment_id' => $appointment->id,
                        'title_en' => "Appointment Canceled",
                        'title_ar' => "تم الغاء الميعاد",
                        'notifiable_id' => $appointment->id,
                        'notifiable_type' => Appointment::class,
                        'message_ar' => 'تم حذف المعاد (#' . $appointment->id . ') بواسطه الدكتور',
                        'message_en' => 'Your Appointment (#' . $appointment->id . ') Has Been Canceled By Doctor'
                    ]);
                    break;

                default:
                    // Notification::create([
                    //     'from_id' => $appointment->hospital_id,
                    //     'to_id' => $appointment->patient_id,
                    //     'appointment_id' => $appointment->id,
                    //     'message' => 'Your Appointment Has Been Canceled By Hospital'
                    // ]);
                    // abort(401);
                    break;
            }
            return redirect()
                ->route('appointments')
                ->with('flash', ['type', 'fail', 'message' => 'Appointment Cancelled']);
        } elseif (request('status') == 'P') {
            return redirect()
                ->route('appointments')
                ->with('flash', ['type', 'fail', 'message' => 'Appointment Booked again wait for the confirmation']);
        }
    }

    public function invoice()
    {
        if (Auth::user()->is_doctor()) {
            return view('doctor.invoice.index', [
                'invoices' => Invoice::query()->where('doctor_id', Auth::id())->orderByDesc('id')->get(),
            ]);
        } elseif (Auth::user()->is_hospital()) {
            return view('hospital.invoice.index', [
                'invoices' => Invoice::query()->where('hospital_id', Auth::user()->hospital_id)->orderByDesc('id')->get(),
            ]);
        } elseif (Auth::user()->is_admin()) {
            return view('admin.invoice.index',
                [
                    'invoices' => Invoice::query()->orderByDesc('id')->get(),
                ]
            );
        } else {
            abort(401);
        }
    }

    public function show_invoice(Invoice $invoice)
    {
        $vat_amount = ($invoice->subtotal * $invoice->vat) / 100;
        $total = $invoice->subtotal + $vat_amount;
        if (Auth::user()->is_doctor() && Auth::user()->id == $invoice->doctor_id) {
            // بيانات ZATCA QR
            $qrData = $this->generateZatcaQr($invoice, $vat_amount, $total);
            $qrCode = QrCode::encoding('UTF-8')->errorCorrection('L')->size(200)->generate($qrData);
            return view('doctor.invoice.show', [
                'invoice' => $invoice,
                'qrCode' => $qrCode
            ]);
        } elseif (Auth::user()->is_hospital() && Auth::user()->hospital_id == $invoice->hospital_id) {
            // بيانات ZATCA QR
            $qrData = $this->generateZatcaQr($invoice, $vat_amount, $total);
            $qrCode = QrCode::encoding('UTF-8')->errorCorrection('L')->size(200)->generate($qrData);
            return view('hospital.invoice.show', [
                'invoice' => $invoice,
                'qrCode' => $qrCode
            ]);
        } elseif (Auth::user()->is_admin()) {
            // بيانات ZATCA QR
            $qrData = $this->generateZatcaQr($invoice, $vat_amount, $total);
            $qrCode = QrCode::encoding('UTF-8')->errorCorrection('L')->size(200)->generate($qrData);
            return view('admin.invoice.show', [
                'invoice' => $invoice,
                'qrCode' => $qrCode
            ]);
        } else {
            abort(401);
        }
    }

    public function update_appointment($id)
    {
        // if (Auth::user()->is_patient()) {
        // $appointment = Appointment::with('doctor')->find($id);
        // // $doctor = User::find($doctor->doctor_id);
        // // dd($appointment);
        // $time_interval = ScheduleSetting::query()->where('hospital_id', $appointment->doctor->hospital_id)->first();
        // for ($i = 0; $i <= 6; $i++) {
        //     if ($appointment->doctor->schedules[$i]->from ?? '') {
        //         $starting_time = $appointment->doctor->schedules[$i]->from;
        //         $end_time = $appointment->doctor->schedules[$i]->to;
        //         if ($time_interval->time_interval ?? '') {
        //             $intervals = CarbonInterval::minutes($time_interval->time_interval)->toPeriod($starting_time, $end_time);
        //         } else {
        //             $intervals = CarbonInterval::minutes(60)->toPeriod($starting_time, $end_time);
        //         }
        //     }
        //     // dd($intervals);
        // }
        $appointment = Appointment::find($id);
        $hospital = Hospital::findOrFail($appointment->hospital_id);
        $insurances = $hospital->insurances;


        // if ($intervals ?? '')
        return view('patient.appointment.update-appointment', [
            'doctor' => User::find($appointment->doctor_id),
            // 'intervals' => $intervals,
            // 'date' => today(),
            // 'unavailablities'=>$unavailablities,
            'insurances' => $insurances,
            'id' => $id

        ]);
        // if ($intervals ?? '') {
        //     return view('patient.appointment.update-appointment', [
        //         'appointment' => $appointment,
        //         'intervals' => $intervals,
        //         'date' => today()
        //     ]);
        // }
        // }
    }

    public function save_update_appointment(Request $request, $id)
    {
        $attributes = $request->validate([
            'doctor_id' => 'required',
            'patient_id' => 'required',
            'hospital_id' => 'required',
            // "schedule_date" => ['required', "date"],
            // 'appointment_date' => 'required',
            // 'appointment_time' => 'required',
            "selected_slot" => "required",
            'status' => 'required',
            // 'insurance'=>?
        ], [
            "selected_slot.required" => "Please select a time slot",
        ]);
        // dd($request->all());
        $doctor = User::where('id', $request->doctor_id)->first();
        $dateTime = CarbonImmutable::parse($request->selected_slot);
        // VAT
        // $invoiceSettings = GenralSettings::where('parent', 'invoice')->get();
        // $invoiceSettings = GenralSettings::makeFlat($invoiceSettings);
        $data = [
            "appointment_date" => $dateTime->format("Y-m-d"),
            "appointment_time" => $dateTime->format("H:i:s"),
            "fee" => $doctor->pricing,
            "status" => 'C'
            // "insurance_id"=> $insurance
            // "vat" => $invoiceSettings->get("vat", 0.0),
        ];
        Appointment::where('id', $id)->update($data);

        // return redirect()
        //     ->route('appointments')
        //     ->with('flash', ['type', 'success', 'message' => 'Appointment create Successfully']);
        return redirect()->route('appointments')->with('flash', ['type', 'success', 'message' => 'Appointment Updated Successfully']);
        // }
    }

    function generateTimeSlots($start_time, $end_time, $interval_minutes)
    {
        $start = Carbon::parse($start_time);
        $end = Carbon::parse($end_time);

        $time_slots = [];

        while ($start < $end) {
            $time_slots[] = $start->format('H:i');
            $start->addMinutes($interval_minutes);
        }

        return $time_slots ?? [];
    }
    public function get_availability(Request $request, $id)
    {
        $doctor = User::find($id);
        $doctor->load("regularAvailabilities", "oneTimeailabilities", "unavailailities");

        // dd($request->selectedDate);
        $time_interval = 15;
        // Create selected CarbonDate instance
        $selectedDate = CarbonImmutable::parse($request->selectedDate);
        $selectedDate->setTimezone(\Auth::user()->timezone);
        // create date
        $date = $selectedDate->format("Y-m-d");
        // day of the week
        $day_name = strtolower($selectedDate->format("l"));

        // Doctor set unavailabilty on a specific date
        $unavailability = $doctor->unavailailities()->where("date", $date)->first();
        // return Not available
        if ($unavailability) {
            return response()->json([
                "status" => "error",
                "message" => "Not Available",
                "data" => [],
            ]);
        }

        // Check if doctor set One time appointment on a specific date
        $availability = null;
        $oneTimeAvailability = $doctor->oneTimeailabilities()->where("date", $date)->first();
        if ($oneTimeAvailability) {
            // Get time intervals to create slots
            $time_interval = $oneTimeAvailability->time_interval ? $oneTimeAvailability->time_interval : 15;
            $availability = $oneTimeAvailability;
        } else {
            $regularAvailability = $doctor->regularAvailabilities()->where("week_day", $day_name)->first();
            if ($regularAvailability) {
                // Get time intervals to create slots
                $time_interval = $regularAvailability->time_interval ? $regularAvailability->time_interval : 15;
                $availability = $regularAvailability;
            }
        }

        // if availability is null
        if (!$availability) {
            return response()->json([
                "status" => "error",
                "message" => "Not Available",
                "data" => [],
            ]);
        }
        // Appointments of selected date
        $appointments = Appointment::where('appointment_date', $date)
            ->where('doctor_id', $doctor->id)
            ->whereIn('status', ['P', 'C'])->pluck("appointment_time");

        // Creating Slots
        $slots = [];
        $filteredSlots = collect([]);
        $intervals = collect($availability->slots);

        // Fliter slots
        foreach ($intervals as $key => $interval) {
            if ($key == 0) {
                $dateTime = \DateTime::createFromFormat('H:i', $interval["end_time"]);
                $int = "PT" . $availability->time_interval . "M";
                $dateTime->sub(new \DateInterval($int));
                $interval["end_time"] = $dateTime->format('H:i');
            }
            $start_dt = $date . $interval["start_time"];
            $end_dt = $date . $interval["end_time"];

            // Create Slots
            $slots = CarbonPeriod::create($start_dt, $availability->time_interval . ' minutes', $end_dt);
            // return $slots;

            foreach ($slots as $slot) {
                $currentTime = Carbon::now(\Auth::user()->timezone);
                $currentTimeFormatted = $currentTime->format('H:i:s');

                // dd($slot->format("H:i:s"),$currentTimeFormatted);
                //$slot->format("H:i:s")>   $currentTimeFormatted &&
                // return Carbon::now(\Auth::user()->timezone)->toDateString();

                if (Carbon::now(\Auth::user()->timezone)->toDateString() == $request->selectedDate) {
                    if ($slot->format("H:i:s") > $currentTimeFormatted &&  $slot->greaterThan(Carbon::now()->addMinutes(20))) {
                        if (!$appointments->contains($slot->format("H:i:s"))) {
                            $filteredSlots->push($slot->format("Y-m-d H:i"));
                        }
                    }
                } else {
                    if ($slot->greaterThan(Carbon::now()->addMinutes(20))) {
                        if (!$appointments->contains($slot->format("H:i:s"))) {
                            $filteredSlots->push($slot->format("Y-m-d H:i"));
                        }
                    }
                }
            }
        }

        return response()->json([
            "status" => "success",
            "message" => "ok",
            "data" => $filteredSlots->unique()->values()->slice(0, -1)->all()
        ]);
    }


    public function invoice_download(Invoice $invoice)
    {
        $vat_amount = ($invoice->subtotal * $invoice->vat) / 100;
        $total = $invoice->subtotal + $vat_amount;
        if (Auth::user()->is_doctor() && Auth::user()->id == $invoice->doctor_id) {
            // بيانات ZATCA QR
            $qrData = $this->generateZatcaQr($invoice, $vat_amount, $total);
            $qrCode = QrCode::encoding('UTF-8')->errorCorrection('L')->size(200)->generate($qrData);

            return view('admin.invoice.download', [
                'invoice' => $invoice,
                'qrCode' => $qrCode
            ]);
        } elseif (Auth::user()->is_hospital() && Auth::user()->hospital_id == $invoice->hospital_id) {
            // بيانات ZATCA QR
            $qrData = $this->generateZatcaQr($invoice, $vat_amount, $total);
            $qrCode = QrCode::encoding('UTF-8')->errorCorrection('L')->size(200)->generate($qrData);

            return view('admin.invoice.download', [
                'invoice' => $invoice,
                'qrCode' => $qrCode
            ]);
        } elseif (Auth::user()->is_admin()) {
            // بيانات ZATCA QR
            $qrData = $this->generateZatcaQr($invoice, $vat_amount, $total);
            $qrCode = QrCode::encoding('UTF-8')->errorCorrection('L')->size(200)->generate($qrData);

            return view('admin.invoice.download', [
                'invoice' => $invoice,
                'qrCode' => $qrCode
            ]);
        } else {
            abort(401);
        }
    }

    private function pemToDer($pem)
    {
        $data = preg_replace('/-----.*-----/', '', $pem);
        $data = str_replace(["\r", "\n"], '', $data);
        return base64_decode($data);
    }
    protected function generateZatcaQr($invoice, $vat_amount, $total)
    {
        // 1️⃣ Generate XML
        $xmlString = $this->generateInvoiceXml($invoice);
        // 2️⃣ Hash
        $rawHash = hash('sha256', $xmlString, true);
        $hashBase64 = base64_encode($rawHash);
        // 3️⃣ Sign with Private Key
        $privateKey = openssl_pkey_get_private(file_get_contents(storage_path('app/private_key.pem')));
        $signature = '';
        openssl_sign($rawHash, $signature, $privateKey, OPENSSL_ALGO_SHA256);
        $signature = base64_encode($signature);
        // 4️⃣ Public Key (convert to DER)
        $publicKeyPem = file_get_contents(storage_path('app/public_key.pem'));
        $publicKeyDer = $this->pemToDer($publicKeyPem);
        // 5️⃣ Certificate (convert to DER)
        $certPem = file_get_contents(storage_path('app/zatca_cert.pem'));
        $certDer = $this->pemToDer($certPem);
        // 6️⃣ TLV Encoding
        $tlvData  = $this->toTLV(1, $invoice->company_name);
        $tlvData .= $this->toTLV(2, $invoice->tax_number);
        $tlvData .= $this->toTLV(3, $invoice->invoice_date->format('Y-m-d\TH:i:sp'));
        $tlvData .= $this->toTLV(4, (string)number_format($total, 2, '.', ''));
        $tlvData .= $this->toTLV(5, (string)number_format($vat_amount, 2, '.', ''));
        // Ensure hash is base64 and valid for ZATCA
        $tlvData .= $this->toTLV(6, rtrim(strtr($hashBase64, '+/', '-_'), '='));
        $tlvData .= $this->toTLV(7, $signature);
        return base64_encode($tlvData);
    }
    private function toTLV($tag, $value)
    {
        $len = strlen($value);

        // Handle variable length encoding (ZATCA spec)
        if ($len < 128) {
            $lengthBytes = chr($len);
        } elseif ($len < 256) {
            $lengthBytes = chr(0x81) . chr($len);
        } else {
            $lengthBytes = chr(0x82) . chr($len >> 8) . chr($len & 0xFF);
        }

        return chr($tag) . $lengthBytes . $value;
    }


    private function generateInvoiceXml($invoice)
    {
        $uuid = Str::uuid()->toString();

        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?>
        <Invoice xmlns="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2"
                xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2"
                xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2"
                xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2">
        </Invoice>');

        // UBLExtensions (mandatory for signing)
        $ext = $xml->addChild('ext:UBLExtensions', null, 'urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2');
        $ext->addChild('ext:UBLExtension', '', 'urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2');

        // Mandatory Fields
        $xml->addChild('cbc:ProfileID', 'reporting:1.0', 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2');
        $xml->addChild('cbc:ID', $invoice->id, 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2');
        $xml->addChild('cbc:UUID', $uuid, 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2');
        $xml->addChild('cbc:IssueDate', $invoice->invoice_date->format('Y-m-d'), 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2');
        $xml->addChild('cbc:IssueTime', $invoice->invoice_date->format('H:i:sP'), 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2');
        $xml->addChild('cbc:InvoiceTypeCode', '388', 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2');
        $xml->addChild('cbc:DocumentCurrencyCode', 'SAR', 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2');

        // Example total
        $legalMonetaryTotal = $xml->addChild('cac:LegalMonetaryTotal', '', 'urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2');
        $legalMonetaryTotal->addChild('cbc:PayableAmount', $invoice->total_amount, 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2')
            ->addAttribute('currencyID', 'SAR');

        return  $xml->asXML();
    }



            // 6️⃣ TLV Encoding
        // $elements = [
        //     [1, $invoice->company_name],        // اسم البائع
        //     [2, $invoice->tax_number],         // رقم الضريبة
        //     [3, $invoice->invoice_date->format('Y-m-d\TH:i:sp')],   // تاريخ الفاتورة
        //     [4, number_format($total, 2)],  // الإجمالي مع الضريبة
        //     [5, number_format($vat_amount, 2)],      // إجمالي الضريبة
        //     [6, $hash],                        // تجزئة الفاتورة
        //     [7, $signature],                   // التوقيع الإلكتروني
        //     // [8, $certificate],                 // شهادة التوقيع
        //     // [9, $publicKey],                   // المفتاح العام
        // ];

        // $tlvData = '';
        // foreach ($elements as [$tag, $value]) {
        //     $tlvData .= $this->toTLV($tag, $value);
        // }

        // $tlvData .= $this->toTLV(8, $certificate);
        // $tlvData .= $this->toTLV(9, $publicKey);

        // // 1. Hash of XML
        // $xmlInvoice = $this->generateInvoiceXml($invoice, $vat_amount, $total);
        // $hash = hash('sha256', $xmlInvoice);
        // $tlvData .= $this->toTLV(6, $hash);

        // // 2. ECDSA signature
        // // الـ Private/Public Keys بتعملهم بعملية CSR + Onboarding API مع ZATCA.
        // $privateKey = openssl_pkey_get_private(file_get_contents(storage_path('app/private_key.pem')));
        // openssl_sign($hash, $signature, $privateKey, OPENSSL_ALGO_SHA256);
        // $tlvData .= $this->toTLV(7, base64_encode($signature));

        // // 3. ECDSA Public Key
        // $publicKey = file_get_contents(storage_path('app/public_key.pem'));
        // $tlvData .= $this->toTLV(8, base64_encode($publicKey));

        // // 4. Certificate signed by ZATCA CA
        // $zatcaCertificate = file_get_contents(storage_path('app/zatca_cert.pem'));
        // $tlvData .= $this->toTLV(9, base64_encode($zatcaCertificate));

    // protected function generateInvoiceXml($invoice, $vat_amount, $total)
    // {
    //     $xml = new \SimpleXMLElement('<Invoice xmlns="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2"></Invoice>');

    //     // Add mandatory namespaces
    //     $xml->addAttribute('xmlns:cac', 'urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2');
    //     $xml->addAttribute('xmlns:cbc', 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2');

    //     // Invoice ID
    //     $xml->addChild('cbc:ID', $invoice->id);

    //     // Invoice Issue Date
    //     $xml->addChild('cbc:IssueDate', $invoice->invoice_date->format('Y-m-d'));

    //     // Seller info
    //     $accountingSupplierParty = $xml->addChild('cac:AccountingSupplierParty');
    //     $party = $accountingSupplierParty->addChild('cac:Party');
    //     $party->addChild('cbc:Name', $invoice->company_name);
    //     $partyTax = $party->addChild('cac:PartyTaxScheme');
    //     $partyTax->addChild('cbc:CompanyID', $invoice->tax_number);

    //     // Buyer info (if available)
    //     $accountingCustomerParty = $xml->addChild('cac:AccountingCustomerParty');
    //     $customerParty = $accountingCustomerParty->addChild('cac:Party');
    //     $customerParty->addChild('cbc:Name', $invoice->patient_name ?? 'Customer');

    //     // Total Amount
    //     $legalMonetaryTotal = $xml->addChild('cac:LegalMonetaryTotal');
    //     $legalMonetaryTotal->addChild('cbc:PayableAmount', number_format($total, 2));

    //     // VAT Amount
    //     $taxTotal = $xml->addChild('cac:TaxTotal');
    //     $taxTotal->addChild('cbc:TaxAmount', number_format($vat_amount, 2));

    //     return $xml->asXML();
    // }
}
