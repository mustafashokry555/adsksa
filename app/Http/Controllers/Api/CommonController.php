<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Hospital;
use App\Models\Speciality;
use App\Models\Specialization;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\Insurance;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Unavailability;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;

class CommonController extends Controller
{
    public function allSpecialities()
    {
        try {
            $speciality = Speciality::all();

            return $this->SuccessResponse(200, 'All specialities reterieved successfully', $speciality);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }

    public function AvailableDoctors()
    {

        try {

            $baseUrl = getenv('BASE_URL') . 'images/';

            $query = User::query()
                ->where('user_type', '=', 'D');
            if (request('search')) {
                $query->where(function ($query) {
                    $query->where('users.name', 'like', '%' . request('search') . '%');
                });
            }
            if (request('status')) {
                $query->where(function ($query) {
                    $query->where('users.status', request('status'));
                });
            }
            if (request('speciality_id')) {
                $query->where(function ($query) {
                    $query->where('users.speciality_id', request('speciality_id'));
                });
            }

            if (request('hospital_id')) {
                $query->where(function ($query) {
                    $query->where('users.hospital_id', request('hospital_id'));
                });
            }

            $doctors = $query->join('specialities', 'specialities.id', 'users.speciality_id')
            ->join('hospitals', 'hospitals.id', 'users.hospital_id')
            ->select(
                'users.id',
                'users.name',
                'users.profile_image',
                DB::raw("CONCAT('$baseUrl', specialities.image) as speciality_image"), 
                'specialities.name as speciality_name',
                'hospitals.hospital_name'
            )
            ->paginate(10);

            return $this->SuccessResponse(200, 'All available doctors', $doctors);

        } catch (\Throwable $th) {

            return $this->ErrorResponse(400, $th->getMessage());
        }
    }

    public function DoctorProfile($id)
    {
        try {

            $baseUrl = getenv('BASE_URL') . 'images/'; // Replace with your actual base URL

            $profile = User::where('users.id', $id)
                ->join('specialities', 'specialities.id', 'users.speciality_id')
                ->join('hospitals', 'hospitals.id', 'users.hospital_id')
                ->select(
                    'users.id',
                    'users.name',
                    'users.profile_image',
                    'users.pricing',
                    'specialities.name as speciality_name',
                    'users.description',
                    DB::raw("CONCAT('$baseUrl', specialities.image) as speciality_image"), // Concatenate the base URL with the image path
                    'hospitals.hospital_name',
                    'hospitals.id as hospital_id'
                )
                ->first();

            $specialization = Specialization::where('user_id', $id)->select('specialization_title')->get();
            $profile['specialization'] = $specialization;
            return $this->SuccessResponse(200, 'Doctor profile', $profile);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }

    // public function DoctorWithFilter(Request $request){
    //     $hospitalName = $request->hospital_name; // Replace with the hospital name you want to filter by
    //     $doctorName = $request->doctor_name; // Replace with the doctor name you want to filter by
    //     $address = $request->address;
    //     $q = User::with('hospital')->where('user_type','D')
    //         ->whereHas('hospital', function ($query) use ($hospitalName) {
    //             $query->where('hospital_name', 'like', '%' . $hospitalName . '%');
    //         });
    //         if($doctorName){
    //             $q->where('name', 'like', '%' . $doctorName . '%');
    //         }
    //         if($address){
    //             $q->where('address', 'like', '%' . $address . '%');
    //         }
           
          
            
    //         $q->get();
    //         return $this->SuccessResponse(200, 'Doctor list', $doctors);
    // }
    public function DoctorWithFilter(Request $request){
        $keyword = $request->search;
        $doctors = User::with(['speciality','hospital','hospital.insurances'])
            ->where('user_type', 'D')
            ->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('address', 'like', '%' . $keyword . '%')
                    ->orWhereHas('hospital', function ($subquery) use ($keyword) {
                        $subquery->where('hospital_name', 'like', '%' . $keyword . '%');
                    })
                    ->orWhereHas('speciality', function ($subquery) use ($keyword) {
                        $subquery->where('name', 'like', '%' . $keyword . '%');
                    })
                    ->orWhereHas('hospital.insurances', function ($subquery) use ($keyword) {
                        $subquery->where('name', 'like', '%' . $keyword . '%');
                    });
            })
            ->get();
    
        return $this->SuccessResponse(200, 'Doctor list', $doctors);
    }
    

    public function BookAppointment(Request $request)
    {

        try {
            $baseUrl = getenv('BASE_URL') . 'images/';
           $isExist = Appointment::where(['appointment_date'=>$request->appointment_date,'appointment_time'=>$request->appointment_time])->first();
           if($isExist){
            return $this->SuccessResponse(200, 'This slot is already booked please try another one',null);
           }
            $a = new Appointment();
            $a->doctor_id = $request->doctor_id;
            $a->patient_id = $request->user()->id;
            $a->hospital_id = $request->hospital_id;
            $a->appointment_date = $request->appointment_date;
            $a->appointment_time = $request->appointment_time;
            $a->appointment_type = $request->appointment_type;
            $a->booking_for = $request->booking_for;
            $a->concern = $request->concern;
            $a->status = "P";
            $a->description = $request->description;

            $a->save();

            $user = User::find($request->user()->id);
            $user->name = $request->name;
            $user->gender = $request->gender;
            $user->age = $request->age;

            $user->save();



            $appointment = Appointment::where('appointments.patient_id', $request->user()->id)
                ->where('appointments.id', $a->id)
                ->join('users as doctoruser', 'doctoruser.id', 'appointments.doctor_id')
                ->join('users as patientuser', 'patientuser.id', 'appointments.patient_id')
                ->join('specialities', 'specialities.id', 'doctoruser.speciality_id')
                ->join('hospitals', 'hospitals.id', 'doctoruser.hospital_id')
                ->select(
                    'doctoruser.name',
                    DB::raw("CONCAT('$baseUrl', doctoruser.profile_image) as profile_image"), // Concatenate the base URL with profile_image
                    'specialities.name as speciality_name',
                    'doctoruser.description',
                    DB::raw("CONCAT('$baseUrl', specialities.image) as speciality_image"), // Concatenate the base URL with speciality_image
                    'hospitals.hospital_name',
                    'hospitals.id as hospital_id',
                    'appointments.booking_for',
                    'appointments.concern',
                    'appointments.appointment_date',
                    'appointments.appointment_time',
                    'appointments.appointment_type',
                    'appointments.description'
                )
                ->first();

            return $this->SuccessResponse(200, 'Appointment details', $appointment);
        } catch (\Throwable $th) {

            return $this->ErrorResponse(400, $th->getMessage());
        }
    }

    public function Hospitals(Request $request)
    {
        $query = Hospital::query();
        if (request('search')) {
            $query->where(function ($query) {
                $query->where('hospital_name', 'like', '%' . request('search') . '%');
            });
        }

        $results = $query->with('insurances')->paginate(10);

        return $this->SuccessResponse(200, 'All Hospitals', $results);
    }


    public function AddToWishlist(Request $request)
    {

        $isExist = DB::table('wishlists')->Where('patient_id', '=', $request->user()->id)
            ->where(function ($query) use ($request) {
                $query->where('doctor_id', '=', $request->doctor_id);
            });
        if ($isExist->first() != null) {
            DB::table('wishlists')->where('id', $isExist->first()->id)->delete();

            return $this->SuccessResponse(200, 'Removed from wishlist!', null);
        }
        DB::table('wishlists')->insert(
            [
                'doctor_id' => $request->doctor_id,
                'patient_id' => $request->user()->id
            ]
        );
        return $this->SuccessResponse(200, 'Added to wishlist!', null);
    }

    public function Wishlist(Request $request)
    {

        $baseUrl = getenv('BASE_URL') . 'images/';

        $doctors = Wishlist::join('users', 'users.id', 'wishlists.doctor_id')
            ->join('specialities', 'specialities.id', 'users.speciality_id')
            ->join('hospitals', 'hospitals.id', 'users.hospital_id')
            ->where('wishlists.patient_id', $request->user()->id)
            ->select(
                'users.id',
                'users.name',
                DB::raw("CONCAT('$baseUrl', users.profile_image) as profile_image"), // Concatenate the base URL with profile_image
                'specialities.name as speciality_name',
                DB::raw("CONCAT('$baseUrl', specialities.image) as speciality_image"), // Concatenate the base URL with speciality_image
                'hospitals.hospital_name'
            )
            ->paginate(10);
        return $this->SuccessResponse(200, 'wishlist  Data', $doctors);
    }

    public function SpecialityDoctors($id)
    {
        try {
            $profile = User::join('specialities', 'specialities.id', 'users.speciality_id')->join('hospitals', 'hospitals.id', 'users.hospital_id')->select('users.id', 'users.name', 'users.profile_image', 'specialities.name as speciality_name', 'users.description', 'specialities.image as speciality_image', 'hospitals.hospital_name', 'hospitals.id as hospital_id')->where('users.speciality_id', $id)->get();

            return $this->SuccessResponse(200, 'Doctor profiles by specialty', $profile);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }

    public function get_availability(Request $request, $id)
    {

        $doctor = User::find($id);
        $doctor->load("regularAvailabilities", "oneTimeailabilities", "unavailailities");

        $time_interval = 15;
        // Create selected CarbonDate instance
        $selectedDate = CarbonImmutable::parse($request->date);
        // create date
        $date = $selectedDate->format("Y-m-d");
        // day of the week
        $day_name = strtolower($selectedDate->format("l"));

        // Doctor set unavailabilty on a specific date
        $unavailability = $doctor->unavailailities()->where("date", $date)->first();
        // return Not available
        if ($unavailability) {

            return $this->SuccessResponse(200, "Not Available", []);
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

            return $this->SuccessResponse(200, "Not Available", []);
        }
        // Appointments of selected date
        $appointments = Appointment::where('appointment_date', $date)
            ->where('doctor_id', $doctor->id)->pluck("appointment_time");

        // Creating Slots
        $slots = [];
        $filteredSlots = collect([]);
        $intervals = collect($availability->slots);

        // Fliter slots
        foreach ($intervals as  $interval) {

            $start_dt = $date . $interval["start_time"];
            $end_dt = $date . $interval["end_time"];

            // Create Slots
            $slots = CarbonPeriod::create($start_dt, $availability->time_interval . ' minutes', $end_dt);

            foreach ($slots as $slot) {

                if ($slot->greaterThan(Carbon::now()->addMinutes(20))) {
                    if (!$appointments->contains($slot->format("H:i:s"))) {
                        $filteredSlots->push($slot->format("H:i"));
                    }
                }
            }
        }


        return $this->SuccessResponse(200, 'Available slots', $filteredSlots->unique()->values()->slice(0, -1)->all());
    }

    public function PatientAppointments(Request $request)
    {
        if (request('appointment_id')) {
            $query = Appointment::query()
                ->where('appointments.patient_id', $request->user()->id)->where('appointments.id', request('appointment_id'));


            $appointment = $query->join('users as doctoruser', 'doctoruser.id', 'appointments.doctor_id')->join('users as patientuser', 'patientuser.id', 'appointments.patient_id')->join('specialities', 'specialities.id', 'doctoruser.speciality_id')->join('hospitals', 'hospitals.id', 'doctoruser.hospital_id')->select('doctoruser.id as doctor_id', 'doctoruser.name', 'doctoruser.profile_image', 'specialities.name as speciality_name', 'doctoruser.description', 'specialities.image as speciality_image', 'hospitals.hospital_name', 'hospitals.id as hospital_id', 'appointments.booking_for', 'appointments.concern', 'appointments.appointment_date', 'appointments.appointment_time', 'appointments.appointment_type', 'appointments.description', 'appointments.status as appointment_status')->orderBy('appointments.id', 'desc')->first();
            $doctoruser = User::find($appointment->doctor_id);

            // Access the "profile_image" attribute using the accessor
            $profileImage = $doctoruser->profile_image;

            // Add the profile_image attribute to the appointment object
            $appointment->profile_image = $profileImage;
            return $this->SuccessResponse(200, 'Patient`s Appointments', $appointment);
        }
        $baseUrl = getenv('BASE_URL') . 'images/'; // Replace with your actual base URL

        $query = Appointment::query()
            ->where('appointments.patient_id', $request->user()->id);

        if (request('status')) {

            switch (request('status')) {
                case 'pending':
                    $s = 'P';
                    break;
                
                case 'confirmed':
                    $s = 'C';
                    break;
                
                case 'cancelled':
                    $s = 'U';
                    break;
                
                case 'd_cancelled':
                    $s = 'D';
                    break;
                            
                default:
                    $s = 'P';
                    break;
            }

            $query->where(function ($query) use ($s){
                $query->orWhere('appointments.status', $s);
            });
        }

        $appointment = $query
            ->join('users as doctoruser', 'doctoruser.id', 'appointments.doctor_id')
            ->join('users as patientuser', 'patientuser.id', 'appointments.patient_id')
            ->join('specialities', 'specialities.id', 'doctoruser.speciality_id')
            ->join('hospitals', 'hospitals.id', 'doctoruser.hospital_id')
            ->select([
                'appointments.id',
                'doctoruser.name',
                DB::raw("CONCAT('$baseUrl', doctoruser.profile_image) as profile_image"),
                'specialities.name as speciality_name',
                'appointments.appointment_date',
                'appointments.appointment_time',
                'appointments.appointment_type',
                'appointments.status as appointment_status',
                'doctoruser.name as doctor_name',
                'hospitals.hospital_name as hospitals_name',
                'patientuser.name as patient_name',
            ])->orderBy('appointments.id', 'desc')
            ->paginate(10);

        return $this->SuccessResponse(200, "Patient's Appointments", $appointment);
    }

    public function CancelAppointment(Request $request){
        Appointment::where('patient_id',$request->user()->id)->where('id',$request->appointment_id)->update(['status'=>'U']);

        return $this->SuccessResponse(200, "Appointment cancelled", null);


    }

    public function get_insurances(Request $request){

        $q = Insurance::query();
        if($request->search){
            $q->where('name', 'LIKE', "%".$request->search."%");
        }
        $insurance = $q->orderBy('id','desc')->paginate(10);

        return $this->SuccessResponse(200, "Patient's Appointments", $insurance);
    }

    public function HospitalsByFilter(Request $request) {
        $query = Hospital::query();
        if(!request('city') && !request('insurance')){
            return $this->SuccessResponse(200,'Hospital not found', []);
        }
        if (request('city')) {
            $query->where('city', 'like', '%' . request('city') . '%');
        }
    
        if (request('insurance')) {
            // Use whereHas to filter hospitals with a specific insurance name
            $query->whereHas('insurances', function ($q) {
                $q->where('name', 'like', '%' . request('insurance') . '%');
            });
        }
    
        $results = $query->with('insurances')->paginate(10);
    
        return $this->SuccessResponse(200, 'All Hospitals', $results);
    }

    public function bestsDoctors(Request $request) {
        // $users = User::select('users.*')
        // ->leftJoin('reviews', 'users.id', '=', 'reviews.doctor_id')
        // ->groupBy('users.id')
        // ->orderByRaw('AVG(reviews.star_rated) DESC')
        // ->get();

        // return $this->SuccessResponse(200, 'All Hospitals', $users);

        try {
            // $profile = User::join('reviews', 'reviews.doctor_id', 'users.id')
            // ->join('specialities', 'specialities.id', 'users.speciality_id')
            // ->join('hospitals', 'hospitals.id', 'users.hospital_id')->where('users.user_type', '=', 'D')
            // ->select('users.id', 'users.name', 'users.profile_image','specialities.name as speciality_name', 'users.description', 'specialities.image as speciality_image', 'hospitals.hospital_name', 'hospitals.id as hospital_id')
            // ->orderByRaw('AVG(reviews.star_rated) DESC')->get();
            $doctors = User::leftJoin('reviews', 'reviews.doctor_id', 'users.id')
            ->join('specialities', 'specialities.id', 'users.speciality_id')
            ->join('hospitals', 'hospitals.id', 'users.hospital_id')
            ->where('users.user_type', '=', 'D')
            ->select('users.id', 'users.name', 'users.profile_image', 'specialities.name as speciality_name', 'users.description', 'specialities.image as speciality_image', 'hospitals.hospital_name', 'hospitals.id as hospital_id', DB::raw('IFNULL(AVG(reviews.star_rated), 0) as avg_rating'))
            ->groupBy('users.id', 'users.name', 'users.profile_image', 'specialities.name', 'users.description', 'specialities.image', 'hospitals.hospital_name', 'hospitals.id')
            ->orderBy('avg_rating', 'DESC')
        
                    ->paginate(12);
            return $this->SuccessResponse(200, 'Doctor profiles by specialty', $doctors);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }
}
