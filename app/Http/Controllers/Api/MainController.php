<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\HospitalResource;
use App\Http\Resources\Api\HospitalTypeResource;
use App\Http\Resources\Api\OfferResource;
use App\Http\Resources\Api\ReligionResource;
use App\Http\Resources\Api\SpecialityResource;
use App\Models\AppSetting;
use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Insurance;
use App\Models\Hospital;
use App\Models\Appointment;
use App\Models\Banner;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Models\HospitalReview;
use App\Models\HospitalType;
use App\Models\Notification;
use App\Models\Offer;
use App\Models\Religion;
use App\Models\Review;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Http;
use Laravel\Sanctum\PersonalAccessToken;

class MainController extends Controller
{
    protected $lang;

    public function __construct(Request $request)
    {
        $this->lang = $request->header('lang', 'en');
    }

    /* Start Home APIs*/
        public function home(Request $request)
        {
            try {
                $token = request()->bearerToken();
                $patient_id = null;
                if ($token) {
                    $tokenModel = PersonalAccessToken::findToken($token);
                    if ($tokenModel) {
                        $patient_id = $tokenModel->tokenable->id; // 'tokenable' refers to the user model
                    }
                }

                $data = [];
                // Banners
                $banners = Banner::where('is_active', 1)
                ->where('expired_at', '>', now())
                ->get();
                // Services
                $hospital_types  = HospitalType::all();
                $hospital_types = HospitalTypeResource::collection($hospital_types);
                // Hospitals
                $hospitals = Hospital::leftJoin('hospital_reviews', 'hospitals.id', '=', 'hospital_reviews.hospital_id')
                ->leftJoin('states', 'hospitals.state_id', '=', 'states.id')
                ->leftJoin('countries', 'states.country_id', '=', 'countries.id')
                ->select(
                    'hospitals.id',
                    'hospitals.hospital_name_ar',
                    'hospitals.hospital_name_en',
                    DB::raw('AVG(hospital_reviews.star_rated) as avg_rating'),
                    'hospitals.image',
                    // 'hospitals.state',
                    DB::raw("NULL AS distance"),
                    'hospitals.lat',
                    'hospitals.long',
                    'hospitals.location',
                    'hospitals.profile_images',
                    "states.name_$this->lang as state_name",
                    "countries.name_$this->lang as country_name"
                )->groupBy(
                    'hospitals.id',
                    'hospitals.hospital_name_en',
                    'hospitals.hospital_name_ar',
                    'hospitals.image',
                    // 'hospitals.state',
                    'hospitals.lat',
                    'hospitals.long',
                    'hospitals.profile_images',
                    'hospitals.location',
                    "states.name_$this->lang",
                    "countries.name_$this->lang"
                )->orderBy('avg_rating', "DESC")->limit(8)->get();
                $hospitals = HospitalResource::collection($hospitals);
                // Offers
                $offers = Offer::where('is_active', 1)
                ->where('start_date', '<=', now())
                ->where('end_date', '>=', now())
                ->get();
                $offers = OfferResource::collection($offers);
                // Cats
                $specialities = Speciality::limit(8)->get();
                $specialities = SpecialityResource::collection($specialities);
                // Doctors
                $doctors = User::leftJoin('hospitals', 'users.hospital_id', '=', 'hospitals.id')
                ->leftJoin('reviews', 'users.id', '=', 'reviews.doctor_id')
                ->leftJoin('wishlists', function ($join) use ($patient_id) {
                    $join->on('users.id', '=', 'wishlists.doctor_id')
                        ->where('wishlists.patient_id', '=', $patient_id);
                })
                ->where('user_type', 'D')
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
                ->orderBy('avg_rating', "DESC")->limit(8)->get();
                // UnRead Notification
                $unread_notification = 0;
                $token = request()->bearerToken();
                $patient_id = null;
                if ($token) {
                    $tokenModel = PersonalAccessToken::findToken($token);
                    if ($tokenModel) {
                        $patient_id = $tokenModel->tokenable->id; // 'tokenable' refers to the user model
                        $unreadCount = Notification::where('to_id', $patient_id)
                        ->where('isRead', 0)
                        ->count();
                        $unread_notification = $unreadCount;
                    }
                }

                // Data
                $data [] = [
                    'banners' => $banners,
                    'hospital_types' => $hospital_types,
                    'hospitals' => $hospitals,
                    'offers' => $offers,
                    'specialities' => $specialities,
                    'doctors' => $doctors,
                    'unread_notification' => $unread_notification,
                ];
                
                return $this->SuccessResponse(200, null, $data);
            } catch (\Throwable $th) {
                return $this->ErrorResponse(400, $th->getMessage());
            }
        }
    /* End Home APIs*/

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
                return response()->json(['error' => $validator->errors(), 'status' => 422],422);
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
        // API for All Countries (Done with Lang)
        public function allCountries(Request $request)
        {
            try {
                $keyword = $request->input('keyword');
                $query = Country::query();
                if ($keyword) {
                    $query->where(function ($query) use ($keyword) {
                        $query->where("name_en", 'like', '%' . $keyword . '%')
                        ->orWhere("name_ar", 'like', '%' . $keyword . '%');
                    });
                }
                $countries = $query->orderBy("name_$this->lang", 'ASC')->get();
                return $this->SuccessResponse(200, 'All Countries reterieved successfully', $countries);
            } catch (\Throwable $th) {
                return $this->ErrorResponse(400, $th->getMessage());
            }
        }
        // API for All Cities (Done with Lang)
        public function allStates(Request $request)
        {
            try {
                $countryIds = $request->input('country_ids') ? json_decode($request->input('country_ids')) : [];
                $keyword = $request->input('keyword');
                
                $states = State::query();
                if (!empty($countryIds)) {
                    $states = $states->whereIn('country_id', $countryIds);
                }
                if ($keyword) {
                    $states = $states->where(function ($q) use ($keyword) {
                        $q->where('name_en', 'LIKE', "%$keyword%")
                        ->orWhere('name_ar', 'LIKE', "%$keyword%");
                    });
                }
                $states = $states->orderBy("name_$this->lang", 'ASC')->get();
                // ->whereHas('hospitals.doctors')
                return $this->SuccessResponse(200, 'All States reterieved successfully', $states);
            } catch (\Throwable $th) {
                return $this->ErrorResponse(400, $th->getMessage());
            }
        }
        // API for All Cities (Done with Lang)
        public function allCities(Request $request)
        {
            try {
                $countryIds = $request->input('country_ids') ? json_decode($request->input('country_ids')) : [];
                $stateIds = $request->input('state_ids') ? json_decode($request->input('state_ids')) : [];
                $keyword = $request->input('keyword');

                $cities = City::query();
                if (!empty($stateIds)) {
                    $cities = $cities->whereIn('state_id', $stateIds);
                }elseif (!empty($countryIds)) {
                    $cities = $cities->whereHas('country', function ($query) use ($countryIds) {
                        $query->whereIn('countries.id', $countryIds);
                    });
                }
                if ($keyword) {
                    $cities = $cities->where(function ($q) use ($keyword) {
                        $q->where('name_en', 'LIKE', "%$keyword%")
                        ->orWhere('name_ar', 'LIKE', "%$keyword%");
                    });
                }
                $cities = $cities->orderBy("name_$this->lang", 'ASC')->get();
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
                if (request('state_ids')) {
                    $hospitals_ids = Hospital::whereIn('state_id', request('state_ids'))
                        ->pluck('id');
                    $query->whereHas('hospitals', function ($query) use ($hospitals_ids) {
                        $query->whereIn('hospital_id', $hospitals_ids);
                    });
                    // return $hospitals_ids;
                }
                if (request('search')) {
                    $query->where(function ($query) {
                        $query->where("name_en", 'like', '%' . request('search') . '%')
                            ->orWhere("name_ar", 'like', '%' . request('search') . '%');
                    });
                }
                $insurance = $query->whereHas('hospitals.doctors')
                ->orderBy('id', 'desc')->get();
                return $this->SuccessResponse(200, "All Insurance reterieved successfully", $insurance);
            } catch (\Throwable $th) {
                return $this->ErrorResponse(400, $th->getMessage());
            }
        }
        // API for All Specialities (Done with Lang)
        public function allSpecialities(Request $request)
        {
            try {
                $hospitals_ids = Hospital::query();
                $query = Speciality::query();
                if (request('state_ids')) {
                    $hospitals_ids = $hospitals_ids->whereIn('state_id', request('state_ids'));
                }
                if (request('insurance_ids')) {
                    $hospitals_ids = $hospitals_ids->whereHas('insurances', function ($query) {
                        $query->whereIn('insurance_id', request('insurance_ids'));
                    });
                }
                $hospitals_ids = $hospitals_ids->pluck('id');
                // return $hospitals_ids;
                if($hospitals_ids){
                    $query->whereHas('users', function ($query) use ($hospitals_ids){
                        $query->whereIn('hospital_id', $hospitals_ids);
                    });
                }
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
                if (request('state_ids')) {
                    $hospital_query = $hospital_query->whereIn('state_id', request('state_ids'));
                }
                if (request('hospital_ids')) {
                    $hospital_query = $hospital_query->whereIn('id', request('hospital_ids'));
                }
                if (request('insurance_ids')) {
                    $hospital_query->whereHas('insurances', function ($query) {
                        $query->whereIn('insurance_id', request('insurance_ids'));
                    });
                }
                $hospital_ids = $hospital_query->pluck('id');
                // return $hospital_ids;
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
                if (request('speciality_ids')) {
                    $query->where(function ($query) {
                        $query->whereIn("speciality_id", request('speciality_ids'));
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

    /* Stert Appointment API's */
        // Start Avail Slot API
        public function get_availability(Request $request, $id)
        {
            $doctor = User::where('id', $id)->where('user_type', User::DOCTOR)->first();
            if(!$doctor){
                return $this->ErrorResponse(404, 'Doctor not found', null);
            }
            $doctor->load("regularAvailabilities", "oneTimeailabilities", "unavailailities");
            // return $doctor;
            // $time_interval = 15;
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
                // $time_interval = $oneTimeAvailability->time_interval ? $oneTimeAvailability->time_interval : 15;
                $availability = $oneTimeAvailability;
            } else {
                $regularAvailability = $doctor->regularAvailabilities()->where("week_day", $day_name)->first();
                if ($regularAvailability) {
                    // Get time intervals to create slots
                    // $time_interval = $regularAvailability->time_interval ? $regularAvailability->time_interval : 15;
                    $availability = $regularAvailability;
                }
            }
                // return $availability;
            // if availability is null
            if (!$availability) {

                return $this->SuccessResponse(200, "Not Available", []);
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
            foreach ($intervals as  $interval) {
                $start_dt = $date . $interval["start_time"];
                $end_dt = $date . $interval["end_time"];
                
                // Create Slots
                $slots = CarbonPeriod::create($start_dt, $availability->time_interval . ' minutes', $end_dt);
                foreach ($slots as $slot) {
                    if ($slot->greaterThan(Carbon::now()->addMinutes(20)) && $slot->lessThan($end_dt)) {
                        if (!$appointments->contains($slot->format("H:i:s"))) {
                            $filteredSlots->push($slot->format("H:i"));
                        }
                    }
                }
            }
            // return $filteredSlots;
            return $this->SuccessResponse(200, 'Available slots', $filteredSlots->unique()->values()->all());
        }

        // Book New Appointmentneed need alot of updates
        public function BookAppointment(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'doctor_id' => 'required',
                'integer',
                // 'hospital_id' => 'required',
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
                $isExist = Appointment::where([
                    'appointment_date' => $request->appointment_date,
                    'appointment_time' => $request->appointment_time,
                    'doctor_id' => $request->doctor_id,
                ])->whereIn('status', ['P', 'C'])->first();
                if ($isExist) {
                    return $this->SuccessResponse(200, 'This slot is already booked please try another one', null);
                }
                $doctor = User::where('id', $request->doctor_id)->first();
                if (!$doctor) {
                    return response()->json([
                        'message' => 'Validation failed',
                        'errors' => 'Doctor not Exist'
                    ], 422);
                }
                $a = new Appointment();
                $a->doctor_id = $request->doctor_id;
                $a->patient_id = $request->user()->id;
                $a->hospital_id = $doctor->hospital_id;
                $a->appointment_date = $request->appointment_date;
                $a->appointment_time = $request->appointment_time;
                $a->appointment_type = $request->appointment_type;
                $a->booking_for = $request->booking_for;
                $a->concern = $request->concern;
                $a->status = "P";
                $a->description = $request->description;
                $a->fee = $doctor->pricing;

                $a->save();
                Notification::create([
                    'from_id' => $a->patient_id,
                    'to_id' => $a->doctor_id,
                    // 'appointment_id' => $appointment->id,
                    'title_en' => "New Appointment",
                    'title_ar' => "ميعاد جديد",
                    'notifiable_id' => $a->id,
                    'notifiable_type' => Appointment::class,
                    'message_ar' => 'تم اضافه ميعاد (#' . $a->id . ') في انتظار الموافقة',
                    'message_en' => 'New Appointment (#' . $a->id . ') is waiting for approval',
                ]);

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
            
            $appointment = Appointment::where('patient_id', $request->user()->id)->where('id', $request->appointment_id)->first();
            $appointment->status = 'U';
            $appointment->save();

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
                ->leftJoin('states', 'hospitals.state_id', '=', 'states.id')
                ->leftJoin('countries', 'states.country_id', '=', 'countries.id')
                    ->select(
                        'hospitals.id',
                        'hospitals.hospital_name_ar',
                        'hospitals.hospital_name_en',
                        DB::raw('AVG(hospital_reviews.star_rated) as avg_rating'),
                        'hospitals.image',
                        'hospitals.state_id',
                        'hospitals.lat',
                        'hospitals.long',
                        'hospitals.location',
                        'hospitals.profile_images',
                        DB::raw('NULL as distance'),
                        "states.name_$this->lang as state_name",
                        "countries.name_$this->lang as country_name"
                    )
                    ->groupBy(
                        'hospitals.id',
                        'hospitals.hospital_name_en',
                        'hospitals.hospital_name_ar',
                        'hospitals.image',
                        'hospitals.state_id',
                        'hospitals.lat',
                        'hospitals.long',
                        'hospitals.profile_images',
                        'hospitals.location',
                        "states.name_$this->lang",
                        "countries.name_$this->lang"
                    );

                if (request('orderBy') == 'recommend') {
                    $query->orderBy('avg_rating', "DESC");
                }
                $hospitals = $query->get();
                if($request->has("long") && $request->has("lat")){
                    foreach ($hospitals as $hospital) {
                        if($hospital->lat != null && $hospital->long != null){
                            $lat = (double)$hospital->lat;
                            $hospitalLatitude = $lat;
                            $hospitalLongitude = $hospital->long;
                            $userLatitude = $request->lat;
                            $userLongitude = $request->long;
                            $hospital['lat'] = $lat;
                            // Make a request to Google Distance Matrix API
                            $response = Http::get("https://maps.googleapis.com/maps/api/distancematrix/json", [
                                'origins' => "$userLatitude,$userLongitude",
                                'destinations' => "$hospitalLatitude,$hospitalLongitude",
                                'key' => "AIzaSyB556JrqytIxxt2hT5hkpLBQdUblve3w5U",
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
                        $hospitals = $hospitals->sortBy(function ($hospital) {
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
                    'doctors', 'specialities', 
                    'offers' => function($query) {
                        $query->where('is_active', 1)
                            ->where('start_date', '<=', now())
                            ->where('end_date', '>=', now());
                    }
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
                $offers = OfferResource::collection($profile->offers);
                unset($profile->offers);
                $profile->offers = $offers;

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

    /* Start Offers APIs*/
        // All Offers
        public function offers(Request $request)
        {
            try {
                $offers = Offer::where('is_active', 1)
                ->where('start_date', '<=', now())
                ->where('end_date', '>=', now());
                if($request->hospital_id){
                    $offers = $offers->where('hospital_id', $request->hospital_id);
                }
                $offers = $offers->get();
                $offers = OfferResource::collection($offers);
                return $this->SuccessResponse(200, null, $offers);
            } catch (\Throwable $th) {
                return $this->ErrorResponse(400, $th->getMessage());
            }
        }
    /* End Offers APIs*/

    public function HospitalsTest(Request $request)
    {
        try {
            $query = Hospital::query();
            if (request('search')) {
                $query->where(function ($query) {
                    $query->where("hospital_name_ar", 'like', '%' . request('search') . '%')
                        ->orWhere("hospital_name_en", 'like', '%' . request('search') . '%');
                });
            }
            if (request('hospital_type_id')) {
                $query->where('hospital_type_id', request('hospital_type_id'));
            }
            
            $query->leftJoin('hospital_reviews', 'hospitals.id', '=', 'hospital_reviews.hospital_id')
            ->leftJoin('states', 'hospitals.state_id', '=', 'states.id')
            ->leftJoin('hospital_types', 'hospitals.hospital_type_id', '=', 'hospital_types.id')
            ->leftJoin('countries', 'states.country_id', '=', 'countries.id')
                ->select(
                    'hospitals.id',
                    'hospitals.hospital_name_ar',
                    'hospitals.hospital_name_en',
                    DB::raw('AVG(hospital_reviews.star_rated) as avg_rating'),
                    'hospitals.image',
                    // 'hospitals.state',
                    DB::raw("NULL AS distance"),
                    'hospitals.lat',
                    'hospitals.long',
                    'hospitals.location',
                    'hospitals.profile_images',
                    "states.name_$this->lang as city_name",
                    "countries.name_$this->lang as country_name",
                    "hospital_types.id as hospital_type_id",
                    "hospital_types.name_$this->lang as hospital_type_name",
                )->groupBy(
                    'hospitals.id',
                    'hospitals.hospital_name_en',
                    'hospitals.hospital_name_ar',
                    'hospitals.image',
                    // 'hospitals.state',
                    'hospitals.lat',
                    'hospitals.long',
                    'hospitals.profile_images',
                    'hospitals.location',
                    "states.name_$this->lang",
                    "countries.name_$this->lang",
                    "hospital_types.id",
                    "hospital_types.name_$this->lang"
                );

            if (request('orderBy') == 'recommend') {
                $query->orderBy('avg_rating', "DESC");
            }
            $hospitals = $query->get();
            $hospitals = HospitalResource::collection($hospitals);
            if (request('orderBy') == 'distance') {
                $hospitalsArray = $hospitals->toArray(request());
                usort($hospitalsArray, function ($a, $b) {
                    if ($a['distance'] === null) return 1;
                    if ($b['distance'] === null) return -1;
                    return $a['distance'] <=> $b['distance'];
                });
                $hospitals = collect($hospitalsArray);
            }
            return $this->SuccessResponse(200, 'Hospitals list', $hospitals);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }

    // religions
    public function getReligions()
    {
        try {
            $religions = Religion::all();
            $religions = ReligionResource::collection($religions);
            return $this->SuccessResponse(200, 'Religions list', $religions);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }

}
