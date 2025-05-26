<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\BannerResource;
use App\Http\Resources\Api\CityResource;
use App\Http\Resources\Api\DoctorResource;
use App\Http\Resources\Api\HospitalResource;
use App\Http\Resources\Api\HospitalTypeResource;
use App\Http\Resources\Api\InsuranceResource;
use App\Http\Resources\Api\OfferResource;
use App\Http\Resources\Api\ReligionResource;
use App\Http\Resources\Api\SpecialityResource;
use App\Http\Resources\Api\StateResource;
use App\Models\AppSetting;
use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Insurance;
use App\Models\Hospital;
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
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
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
                $hospitals = Hospital::withAvg('hospitalReviews', 'star_rated')
                ->orderByDesc('hospital_reviews_avg_star_rated')
                ->limit(8)
                ->get();
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
                $doctors = User::where('user_type', 'D')->withAvg('reviews', 'star_rated')
                    ->orderByDesc('reviews_avg_star_rated')
                    ->limit(8)
                    ->get();
                // $doctors = $doctors ? DoctorResource::collection($doctors) : [];
                // $doctors = $doctors->sortByDesc(fn($doctor) => $doctor->avg_rate)->values();
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
                    'banners' => $banners ? BannerResource::collection($banners) : [],
                    'hospital_types' => $hospital_types,
                    'hospitals' => $hospitals ? HospitalResource::collection($hospitals) : [],
                    'offers' => $offers,
                    'specialities' => $specialities,
                    'doctors' => $doctors ? DoctorResource::collection($doctors) : [] ,
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
                return $this->SuccessResponse(200, 'All States reterieved successfully',
                StateResource::collection($states));
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
                return $this->SuccessResponse(200, 'All Cities reterieved successfully',
                CityResource::collection($cities));
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
                return $this->SuccessResponse(200, "All Insurance reterieved successfully",
                InsuranceResource::collection($insurance));
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
                        DB::raw('IF(wishlists.id IS NOT NULL, 1, 0) as is_favorited'),
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
                    $profile->avg_rating = $profile->avg_rating ? (int)$profile->avg_rating : 0;
                    $profile->reviews_count = $profile->reviews_count ? (int)$profile->reviews_count : 0;
                    $profile->is_favorited = (int)$profile->is_favorited;
                    $profile->pricing = $profile->pricing ? (int)$profile->pricing : null;
                    $profile->hospital_id = $profile->hospital_id ? (int)$profile->hospital_id : 0;
                    $profile->speciality_id = $profile->speciality_id ? (int)$profile->speciality_id : 0;
                    if($profile->hospital){
                        $profile->hospital->lat = $profile->hospital->lat ? (float)$profile->hospital->lat : null;
                        $profile->hospital->long = $profile->hospital->long ? (float)$profile->hospital->long : null;
                    }
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
    /* End Doctor APIs*/

    ////////////////////////////////////////////////////////////////////////////////////////
    /* Start Hospital APIs*/
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
