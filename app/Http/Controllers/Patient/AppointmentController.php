<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Notification;
use App\Models\ScheduleSetting;
use App\Models\Review;
use App\Models\User;
use App\Models\Insurance;
use App\Models\Hospital;
use App\Models\Speciality;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Unavailability;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;

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
            "status"=>'C'
            // "insurance_id"=> $insurance
            // "vat" => $invoiceSettings->get("vat", 0.0),
        ]);
        Appointment::create($request->except("selected_slot"));

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
            return redirect()
                ->route('appointments')
                ->with('flash', ['type', 'success', 'message' => 'Appointment Confirmed']);
        } elseif (request('status') == 'D') {
            switch ($user_type) {
                case 'U':
                    Notification::create([
                        'from_id' => $appointment->patient_id,
                        'to_id' => $appointment->doctor_id,
                        'appointment_id' => $appointment->id,
                        'message' => 'Appointment (#' . $appointment->id . ') Has Been Canceled By Patient'
                    ]);
                    break;

                case 'D':
                    Notification::create([
                        'from_id' => $appointment->doctor_id,
                        'to_id' => $appointment->patient_id,
                        'appointment_id' => $appointment->id,
                        'message' => 'Your Appointment (#' . $appointment->id . ') Has Been Canceled By Doctor'
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
                'invoices' => Appointment::query()->where('doctor_id', Auth::id())->orderByDesc('id')->get(),
            ]);
        } elseif (Auth::user()->is_hospital()) {
            return view('hospital.invoice.index', [
                'invoices' => Appointment::query()->where('hospital_id', Auth::user()->hospital_id)->orderByDesc('id')->get(),
            ]);
        } elseif (Auth::user()->is_admin()) {
            return view(
                'admin.invoice.index',
                [
                    'invoices' => Appointment::query()->orderByDesc('id')->get(),
                ]
            );
        } else {
            abort(401);
        }
    }

    public function show_invoice(Appointment $invoice)
    {

        if (Auth::user()->is_doctor() && Auth::user()->id == $invoice->doctor_id) {
            return view('doctor.invoice.show', [
                'invoice' => $invoice
            ]);
        } elseif (Auth::user()->is_hospital() && Auth::user()->hospital_id == $invoice->hospital_id) {
            return view('hospital.invoice.show', [
                'invoice' => $invoice
            ]);
        } elseif (Auth::user()->is_admin()) {
            return view('admin.invoice.show', [
                'invoice' => $invoice,
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
                'id'=>$id

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
            "status"=>'C'
            // "insurance_id"=> $insurance
            // "vat" => $invoiceSettings->get("vat", 0.0),
        ];
        Appointment::where('id',$id)->update($data);

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
            ->where('doctor_id', $doctor->id)->pluck("appointment_time");

        // Creating Slots
        $slots = [];
        $filteredSlots = collect([]);
        $intervals = collect($availability->slots);

        // Fliter slots
        foreach ($intervals as $key => $interval) {
            if($key==0){
                $dateTime = \DateTime::createFromFormat('H:i', $interval["end_time"]);
                $int = "PT".$availability->time_interval."M";
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
                
                if(Carbon::now(\Auth::user()->timezone)->toDateString()==$request->selectedDate){
                    if ( $slot->format("H:i:s") > $currentTimeFormatted &&  $slot->greaterThan(Carbon::now()->addMinutes(20))) {
                        if (!$appointments->contains($slot->format("H:i:s"))) {
                            $filteredSlots->push($slot->format("Y-m-d H:i"));
                        }
                    }
                }else{
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
}
