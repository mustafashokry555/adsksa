<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Insurance;
use App\Models\Hospital;
use App\Models\Appointment;
use App\Models\Banner;
use App\Models\HospitalReview;
use App\Models\Review;
use App\Models\Specialization;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\Unavailability;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Laravel\Sanctum\PersonalAccessToken;

class MainController extends Controller
{
    protected $lang;

    public function __construct(Request $request)
    {
        $this->lang = $request->header('lang', 'en');
    }

    /* Start Setting APIs*/
        // API for Update Or Create App Setting (Done)
        public function updateOrCreateAppSetting(Request $request)
        {
            try {
                $request->validate([
                    'notifications' => 'nullable|boolean',
                    'msg_option' => 'nullable|boolean',
                    'call_option' => 'nullable|boolean',
                    'video_call_option' => 'nullable|boolean',
                ]);
                $user = $request->user();

                $AppSetting = AppSetting::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'notifications' => $request->notifications ?? '0',
                        'msg_option' => $request->msg_option ?? '0',
                        'call_option' => $request->call_option ?? '0',
                        'video_call_option' => $request->video_call_option ?? '0',
                    ]
                );

                return $this->SuccessResponse(200, null, $AppSetting);
            } catch (\Throwable $th) {
                return $this->ErrorResponse(400, $th->getMessage());
            }
        }
        // Make Complain
        function makeComplaint(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'subject' => 'required|string',
                'name' => 'required|string',
                'email' => 'required|email',
                'mobile' => 'required|numeric|digits:9',
                'comment' => 'required|string',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors(), 'errorAr' => $validator->errors(), 'status' => 422]);
            }
            try {
                // Create a new row in the table
                $dateTime = Carbon::now();
                $row = DB::table('patient_comments')
                    ->insert([
                        "subject" => $request->subject,
                        "name" => $request->name,
                        "mobile" => $request->mobile,
                        "email" => $request->email,
                        "comment" => $request->comment,
                        "created_at" => $dateTime,
                        "updated_at" => $dateTime
                    ]);
                return $this->SuccessResponse(200, "Comment Done..", $row);
            } catch (\Throwable $th) {
                // return $th;
                return $this->ErrorResponse(400, $th->getMessage());
            }
        }
    /* End Setting APIs*/

    ////////////////////////////////////////////////////////////////////////////////////////

    /* Start Search For Doctors APIs*/
        // API for All Specialities (Done with Lang)
        public function allSpecialities(Request $request)
        {
            try {
                $query = Speciality::query();
                if (request('search')) {
                    $query->where(function ($query) {
                        $query->where("name_en", 'like', '%' . request('search') . '%')
                            ->orWhere("name_ar", 'like', '%' . request('search') . '%');
                    });
                }
                $speciality = $query->get();
                return $this->SuccessResponse(200, 'All specialities reterieved successfully', $speciality);
            } catch (\Throwable $th) {
                return $this->ErrorResponse(400, $th->getMessage());
            }
        }
        // API for All Cities (Done with Lang)
        public function allCities(Request $request)
        {
            try {
                $query = Hospital::query();
                if (request('search')) {
                    $query->where(function ($query) {
                        $query->where("city", 'like', '%' . request('search') . '%');
                    });
                }
                $cities = $query->select('city', 'hospital_name_en', 'hospital_name_ar')
                ->groupBy('city', 'hospital_name_en', 'hospital_name_ar')->get();
                return $this->SuccessResponse(200, 'All Cities reterieved successfully', $cities);
            } catch (\Throwable $th) {
                return $this->ErrorResponse(400, $th->getMessage());
            }
        }
        // API for All Insurances (Done with Lang)
        public function get_insurances(Request $request)
        {
            try {
                $query = Insurance::query();
                if (request('city')) {
                    $hospitals_ids = Hospital::where('city', 'like', '%' . request('city') . '%')
                        ->pluck('id');
                    $query->whereHas('hospitals', function ($query) use ($hospitals_ids) {
                        $query->whereIn('hospital_id', $hospitals_ids);
                    });
                }
                if (request('search')) {
                    $query->where(function ($query) {
                        $query->where("name_en", 'like', '%' . request('search') . '%')
                            ->orWhere("name_ar", 'like', '%' . request('search') . '%');
                    });
                }
                $insurance = $query->orderBy('id', 'desc')->get();
                return $this->SuccessResponse(200, "All Insurance reterieved successfully", $insurance);
            } catch (\Throwable $th) {
                return $this->ErrorResponse(400, $th->getMessage());
            }
        }
        // API for All Doctoes (Done with Out Lang)
        public function DoctorWithFilter(Request $request)
        {
            $token = request()->bearerToken();
            $patient_id = null;
            if ($token) {
                $tokenModel = PersonalAccessToken::findToken($token);
                if ($tokenModel) {
                    $patient_id = $tokenModel->tokenable->id; // 'tokenable' refers to the user model
                }
            }
            try {
                $hospital_query = Hospital::query();
                if (request('insurance') && !empty(request('insurance'))) {
                    $hospital_query->whereHas('insurances', function ($query) {
                        $query->whereIn('insurance_id', request('insurance'));
                    });
                }
                if (request('city')) {
                    $hospital_query = $hospital_query->where('city', 'like', '%' . request('city') . '%');
                }
                $hospital_ids = $hospital_query->pluck('id');
                $query = User::query();
                $query->leftJoin('hospitals', 'users.hospital_id', '=', 'hospitals.id');
                if (request('search')) {
                    $query->where(function ($query) {
                        $query->where("name_en", 'like', '%' . request('search') . '%')
                            ->orWhere("name_ar", 'like', '%' . request('search') . '%')
                            ->orWhere("hospitals.hospital_name_en", 'like', '%' . request('search') . '%')
                            ->orWhere("hospitals.hospital_name_ar", 'like', '%' . request('search') . '%');
                    });
                }
                if (request('speciality') && !empty(request('speciality'))) {
                    $query->where(function ($query) {
                        $query->whereIn("speciality_id", request('speciality'));
                    });
                }

                // Perform the left join with the reviews table
                $query->leftJoin('reviews', 'users.id', '=', 'reviews.doctor_id')
                    ->leftJoin('wishlists', function ($join) use ($patient_id) {
                        $join->on('users.id', '=', 'wishlists.doctor_id')
                            ->where('wishlists.patient_id', '=', $patient_id);
                    })
                    ->where('user_type', 'D')
                    ->whereIn('users.hospital_id', $hospital_ids)
                    ->select(
                        'users.id',
                        'users.name_en',
                        'users.name_ar',
                        DB::raw('AVG(reviews.star_rated) as avg_rating'),
                        DB::raw('COUNT(reviews.id) as reviews_count'),
                        'users.profile_image',
                        DB::raw('IF(wishlists.id IS NOT NULL, TRUE, FALSE) as is_favorited'),
                        'users.gender',
                        'users.pricing',
                        'users.hospital_id',
                        'users.speciality_id',
                    )
                    ->with([
                        'hospital' => function ($query) {
                            $query->select([
                                'id',
                                'hospital_name_en',
                                'hospital_name_ar',
                                'lat',
                                'long',
                            ]);
                        },
                        'speciality' => function ($query) {
                            $query->select([
                                'id',
                                'name_en',
                                'name_ar',
                            ]);
                        }
                    ])
                    ->groupBy(
                        'wishlists.id',
                        'users.id',
                        'users.hospital_id',
                        'users.speciality_id',
                        'users.name_en',
                        'users.pricing',
                        'users.gender',
                        'users.name_ar',
                        'users.profile_image'
                    );

                if (request('orderBy') == 'low_price') {
                    $query->orderBy('users.pricing', "ASC");
                } elseif (request('orderBy') == 'high_price') {
                    $query->orderBy('users.pricing', "DESC");
                } elseif (request('orderBy') == 'recommend') {
                    $query->orderBy('avg_rating', "DESC");
                }
                $doctors = $query->get();
                return $this->SuccessResponse(200, 'Doctor list', $doctors);
            } catch (\Throwable $th) {
                return $this->ErrorResponse(400, $th->getMessage());
            }
        }
    /* End Search For Doctors APIs*/

    ////////////////////////////////////////////////////////////////////////////////////////

    /* Start Doctor APIs*/
        // Start DoctorProfile API
        public function DoctorProfile($id)
        {
            $token = request()->bearerToken();
            $patient_id = null;
            if ($token) {
                $tokenModel = PersonalAccessToken::findToken($token);
                if ($tokenModel) {
                    $patient_id = $tokenModel->tokenable->id; // 'tokenable' refers to the user model
                }
            }
            try {
                $profile = User::where('users.id', $id)
                    ->leftJoin('reviews', 'users.id', '=', 'reviews.doctor_id')
                    ->leftJoin('wishlists', function ($join) use ($patient_id) {
                        $join->on('users.id', '=', 'wishlists.doctor_id')
                            ->where('wishlists.patient_id', '=', $patient_id);
                    })
                    ->select(
                        'users.id',
                        "users.name_ar",
                        'users.name_en',
                        'users.profile_image',
                        DB::raw('AVG(reviews.star_rated) as avg_rating'),
                        DB::raw('COUNT(reviews.id) as reviews_count'),
                        DB::raw('IF(wishlists.id IS NOT NULL, TRUE, FALSE) as is_favorited'),
                        'users.gender',
                        'users.pricing',
                        'users.hospital_id',
                        'users.speciality_id'
                    )
                    ->with([
                        'hospital' => function ($query) {
                            $query->select([
                                'id',
                                'hospital_name_ar',
                                'hospital_name_en',
                                'lat',
                                'long',
                            ]);
                        },
                        'speciality' => function ($query) {
                            $query->select([
                                'id',
                                'name_en',
                                'name_ar',
                            ]);
                        }
                    ])
                    ->groupBy(
                        'wishlists.id',
                        'users.id',
                        'users.hospital_id',
                        'users.speciality_id',
                        'users.name_en',
                        'users.pricing',
                        'users.gender',
                        'users.name_ar',
                        'users.profile_image'
                    )
                    ->first();
                return $this->SuccessResponse(200, 'Doctor profile', $profile);
            } catch (\Throwable $th) {
                return $this->ErrorResponse(400, $th->getMessage());
            }
        }
        // Start bestsDoctors API
        public function bestsDoctors(Request $request)
        {
            $token = request()->bearerToken();
            $patient_id = null;
            if ($token) {
                $tokenModel = PersonalAccessToken::findToken($token);
                if ($tokenModel) {
                    $patient_id = $tokenModel->tokenable->id; // 'tokenable' refers to the user model
                }
            }
            try {
                $doctors = User::leftJoin('reviews', 'reviews.doctor_id', 'users.id')
                    ->leftJoin('wishlists', function ($join) use ($patient_id) {
                        $join->on('users.id', '=', 'wishlists.doctor_id')
                            ->where('wishlists.patient_id', '=', $patient_id);
                    })
                    ->where('users.user_type', '=', 'D')
                    ->select(
                        'users.id',
                        'users.name_en',
                        'users.name_ar',
                        DB::raw('AVG(reviews.star_rated) as avg_rating'),
                        DB::raw('COUNT(reviews.id) as reviews_count'),
                        'users.profile_image',
                        DB::raw('IF(wishlists.id IS NOT NULL, TRUE, FALSE) as is_favorited'),
                        'users.gender',
                        'users.pricing',
                        'users.hospital_id',
                        'users.speciality_id',
                    )
                    ->with([
                        'hospital' => function ($query) {
                            $query->select([
                                'id',
                                'hospital_name_en',
                                'hospital_name_ar',
                                'lat',
                                'long',
                            ]);
                        },
                        'speciality' => function ($query) {
                            $query->select([
                                'id',
                                'name_en',
                                'name_ar',
                            ]);
                        }
                    ])
                    ->groupBy(
                        'wishlists.id',
                        'users.id',
                        'users.hospital_id',
                        'users.speciality_id',
                        'users.name_en',
                        'users.pricing',
                        'users.gender',
                        'users.name_ar',
                        'users.profile_image'
                    )
                    ->orderBy('avg_rating', 'DESC')
                    ->paginate(12);
                return $this->SuccessResponse(200, 'Doctor profiles by specialty', $doctors);
            } catch (\Throwable $th) {
                return $this->ErrorResponse(400, $th->getMessage());
            }
        }
        // review Doc
        public function add_review(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'doctor_id' => 'required',
                'hospital_id' => 'required',
                'star_rated' => 'required|integer|between:0,5',
                'review_title' => 'required',
                'review_body' => 'required|max:100',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors(), 'errorAr' => $validator->errors(), 'status' => 422]);
            }
            try {
                $doctor = User::where([
                    'id' => $request->doctor_id,
                    'user_type' => User::DOCTOR,
                    'hospital_id' => $request->hospital_id,
                ])->first();
                if (!$doctor) {
                    return $this->ErrorResponse(400, "Invalid Data");
                }
                $user = $request->user();
                $review = Review::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'doctor_id' => $request->doctor_id,
                        'hospital_id' => $request->hospital_id,
                    ],
                    [
                        'star_rated' => $request->star_rated,
                        'review_title' => $request->review_title,
                        'review_body' => $request->review_body,
                    ]
                );
                return $this->SuccessResponse(200, "Thank You for rating my profile.!", $review);
            } catch (\Throwable $th) {
                // return $th;
                return $this->ErrorResponse(400, $th->getMessage());
            }
        }
    /* End Doctor APIs*/

    ////////////////////////////////////////////////////////////////////////////////////////

    /* Start wish List Part*/
        public function AddToWishlist(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'doctor_id' => 'required',
                'integer',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }
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
                    DB::raw("IFNULL(users.name_{$this->getLang()}, users.name_en) as name"),
                    DB::raw("CONCAT('$baseUrl', users.profile_image) as profile_image"),
                    DB::raw("IFNULL(specialities.name_{$this->getLang()}, specialities.name_en) as speciality_name"),
                    DB::raw("CONCAT('$baseUrl', specialities.image) as speciality_image"),
                    DB::raw("IFNULL(hospitals.hospital_name_{$this->getLang()}, hospitals.hospital_name_en) as hospital_name"),
                )
                ->get();
            return $this->SuccessResponse(200, 'wishlist  Data', $doctors);
        }
    /* End wish List Part*/

    ////////////////////////////////////////////////////////////////////////////////////////


    /* Stert Appointment API's */
        // Start Avail Slot API
        public function get_availability(Request $request, $id)
        {
            $doctor = User::find($id);
            $doctor->load("regularAvailabilities", "oneTimeailabilities", "unavailailities");
            // return $doctor;
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
        // Book New Appointmentneed need alot of updates
        public function BookAppointment(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'doctor_id' => 'required',
                'integer',
                'hospital_id' => 'required',
                'integer',
                'appointment_date' => 'required|date_format:Y-m-d',
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
                $isExist = Appointment::where(['appointment_date' => $request->appointment_date, 'appointment_time' => $request->appointment_time])->first();
                if ($isExist) {
                    return $this->SuccessResponse(200, 'This slot is already booked please try another one', null);
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

                // $user = User::find($request->user()->id);
                // $user->name = $request->name;
                // $user->gender = $request->gender;
                // $user->age = $request->age;

                // $user->save();

                $appointment = Appointment::where('appointments.patient_id', $request->user()->id)
                    ->where('appointments.id', $a->id)
                    ->join('users as doctoruser', 'doctoruser.id', 'appointments.doctor_id')
                    ->join('users as patientuser', 'patientuser.id', 'appointments.patient_id')
                    ->join('specialities', 'specialities.id', 'doctoruser.speciality_id')
                    ->join('hospitals', 'hospitals.id', 'doctoruser.hospital_id')
                    ->select(
                        DB::raw("IFNULL(doctoruser.name_{$this->getLang()}, doctoruser.name_en) as doctor_name"),
                        DB::raw("CONCAT('$baseUrl', doctoruser.profile_image) as profile_image"),
                        DB::raw("IFNULL(specialities.name_{$this->getLang()}, specialities.name_en) as speciality_name"),
                        'doctoruser.description',
                        DB::raw("CONCAT('$baseUrl', specialities.image) as speciality_image"),
                        DB::raw("IFNULL(hospitals.hospital_name_{$this->getLang()}, hospitals.hospital_name_en) as hospital_name"),
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
        // Show the Patient Appointment
        public function PatientAppointments(Request $request)
        {
            // single Appointment
            if (request('appointment_id')) {
                $query = Appointment::query()
                    ->where('appointments.patient_id', $request->user()->id)->where('appointments.id', request('appointment_id'));

                $appointment = $query->join('users as doctoruser', 'doctoruser.id', 'appointments.doctor_id')
                    ->join('users as patientuser', 'patientuser.id', 'appointments.patient_id')
                    ->join('specialities', 'specialities.id', 'doctoruser.speciality_id')
                    ->join('hospitals', 'hospitals.id', 'doctoruser.hospital_id')
                    ->select(
                        'doctoruser.id as doctor_id',
                        DB::raw("IFNULL(doctoruser.name_{$this->getLang()}, doctoruser.name_en) as doctor_name"),
                        'doctoruser.profile_image',
                        DB::raw("IFNULL(specialities.name_{$this->getLang()}, specialities.name_en) as speciality_name"),
                        'doctoruser.description',
                        'specialities.image as speciality_image',
                        DB::raw("IFNULL(hospitals.hospital_name_{$this->getLang()}, hospitals.hospital_name_en) as hospital_name"),
                        'hospitals.id as hospital_id',
                        'appointments.booking_for',
                        'appointments.concern',
                        'appointments.appointment_date',
                        'appointments.appointment_time',
                        'appointments.appointment_type',
                        'appointments.description',
                        'appointments.status as appointment_status'
                    )->orderBy('appointments.id', 'desc')->first();
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

                $query->where(function ($query) use ($s) {
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
                    DB::raw("IFNULL(doctoruser.name_{$this->getLang()}, doctoruser.name_en) as doctor_name"),
                    DB::raw("CONCAT('$baseUrl', doctoruser.profile_image) as profile_image"),
                    DB::raw("IFNULL(specialities.name_{$this->getLang()}, specialities.name_en) as speciality_name"),
                    'appointments.appointment_date',
                    'appointments.appointment_time',
                    'appointments.appointment_type',
                    'appointments.status as appointment_status',
                    DB::raw("IFNULL(hospitals.hospital_name_{$this->getLang()}, hospitals.hospital_name_en) as hospital_name"),
                    DB::raw("IFNULL(patientuser.name_{$this->getLang()}, patientuser.name_en) as patient_name"),
                ])->orderBy('appointments.id', 'desc')
                ->get();

            return $this->SuccessResponse(200, "Patient's Appointments", $appointment);
        }
        // cancel the appointment
        public function CancelAppointment(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'appointment_id' => 'required',
                'integer',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }
            Appointment::where('patient_id', $request->user()->id)->where('id', $request->appointment_id)->update(['status' => 'U']);

            return $this->SuccessResponse(200, "Appointment cancelled", null);
        }
    /* End Appointment API's */

    ////////////////////////////////////////////////////////////////////////////////////////

    /* Start Hospital APIs*/
        // review Hospital
        public function add_hospital_review(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'hospital_id' => 'required',
                'star_rated' => 'required|integer|between:0,5',
                'review_title' => 'required',
                'review_body' => 'required|max:100',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors(), 'errorAr' => $validator->errors(), 'status' => 422]);
            }
            try {
                $hospital = Hospital::where('id', $request->hospital_id)->first();
                if (!$hospital) {
                    return $this->ErrorResponse(400, "Invalid Data");
                }
                $user = $request->user();
                $review = HospitalReview::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'hospital_id' => $request->hospital_id,
                    ],
                    [
                        'star_rated' => $request->star_rated,
                        'review_title' => $request->review_title,
                        'review_body' => $request->review_body,
                    ]
                );
                return $this->SuccessResponse(200, "Thank You for rating my profile.!", $review);
            } catch (\Throwable $th) {
                // return $th;
                return $this->ErrorResponse(400, $th->getMessage());
            }
        }
        // API for All hospitals (Done with Out Lang)
        public function HospitalWithFilter(Request $request)
        {
            try {
                $query = Hospital::query();
                if (request('search')) {
                    $query->where(function ($query) {
                        $query->where("hospital_name_ar", 'like', '%' . request('search') . '%')
                            ->orWhere("hospital_name_en", 'like', '%' . request('search') . '%');
                    });
                }
                $query->leftJoin('hospital_reviews', 'hospitals.id', '=', 'hospital_reviews.hospital_id')
                    ->select(
                        'hospitals.id',
                        'hospitals.hospital_name_ar',
                        'hospitals.hospital_name_en',
                        DB::raw('AVG(hospital_reviews.star_rated) as avg_rating'),
                        'hospitals.image',
                        'hospitals.state',
                        'hospitals.lat',
                        'hospitals.long',
                        'hospitals.location',
                        DB::raw('NULL as distance')
                    )
                    ->groupBy(
                        'hospitals.id',
                        'hospitals.hospital_name_en',
                        'hospitals.hospital_name_ar',
                        'hospitals.image',
                        'hospitals.state',
                        'hospitals.lat',
                        'hospitals.long',
                        'hospitals.location'
                    );

                if (request('orderBy') == 'recommend') {
                    $query->orderBy('avg_rating', "DESC");
                }
                $hospitals = $query->get();
                if($request->has("long") && $request->has("lat")){
                    foreach ($hospitals as $hospital) {
                        if($hospital->lat != null && $hospital->long != null){
                            $hospitalLatitude = $hospital->lat;
                            $hospitalLongitude = $hospital->long;
                            $userLatitude = $request->lat;
                            $userLongitude = $request->long;
                            // Make a request to Google Distance Matrix API
                            $response = Http::get("https://maps.gomaps.pro/maps/api/distancematrix/json", [
                                'origins' => "$userLatitude,$userLongitude",
                                'destinations' => "$hospitalLatitude,$hospitalLongitude",
                                'key' => "AlzaSy-3tB5867_WHmOPY60IqX5tIwWvoyLik0m",
                            ]);
                            // Parse the response to get the distance in kilometers
                            if ($response->successful()) {
                                $data = $response->json();
                                $distanceInMeters = $data['rows'][0]['elements'][0]['distance']['value'] ?? null;
                                if ($distanceInMeters) {
                                    $distanceInKilometers = $distanceInMeters / 1000; // Convert meters to kilometers
                                    $hospital['distance'] = round($distanceInKilometers,2);
                                }
                            }
                        }
                    }
                    if (request('orderBy') == 'distance') {
                        $hospitals = $hospitals->sortByDesc(function ($hospital) {
                            return $hospital->distance;
                        })->values();
                    }
                }


                return $this->SuccessResponse(200, 'Hospitals list', $hospitals);
            } catch (\Throwable $th) {
                return $this->ErrorResponse(400, $th->getMessage());
            }
        }
        // Hospital profile
        public function hospitalProfile($id)
        {
            try {
                $profile = Hospital::where('hospitals.id', $id)
                ->with([
                    'doctors', 'specialities'
                ])
                ->first();
                
                $profile->avg_rating = $profile->avg_rating;
                $profile->rating_count = $profile->rating_count;
                $doctorsList = [];
                foreach ($profile->doctors as $doctor) {
                    $d = [];
                    $d['id'] = $doctor->id;
                    $d['name'] = $doctor["name_$this->lang"] ?? $doctor->name_en;
                    $d['profile_image'] = $doctor->profile_image;
                    $d['hospital_id'] = $doctor->hospital_id;
                    $d['avg_rating'] = $doctor->avg_rating;
                    $d['rating_count'] = $doctor->rating_count;
                    $d['speciality_id'] = $doctor->speciality->id;
                    $d['speciality_name'] = $doctor->speciality->name;
                    $doctorsList[] = $d;
                }
                unset($profile->doctors);
                $profile->doctors = $doctorsList;
                return $this->SuccessResponse(200, 'Hospital Profile', $profile);
            } catch (\Throwable $th) {
                return $this->ErrorResponse(400, $th->getMessage());
            }
        }
    /* End hospitals APIs*/

    ////////////////////////////////////////////////////////////////////////////////////////

    /* Start Banners APIs*/
        // All Banners
        public function banners(Request $request)
        {
            try {
                $banners = Banner::where('is_active', 1)
                ->where('expired_at', '>', now())
                ->get();
                return $this->SuccessResponse(200, null, $banners);
            } catch (\Throwable $th) {
                return $this->ErrorResponse(400, $th->getMessage());
            }
        }
    /* End Banners APIs*/

}
