<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\BannerResource;
use App\Http\Resources\Api\CityResource;
use App\Http\Resources\Api\DoctorProfileResource;
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
            $banners = Banner::where('is_active', 1)->whereHas('hospital', function ($q) {
                $q->where('is_active', 1);
            })
                ->where('expired_at', '>', now())
                ->get();
            // Services
            $hospital_types  = HospitalType::all();
            $hospital_types = HospitalTypeResource::collection($hospital_types);
            // Hospitals
            $hospitals = Hospital::active()->withAvg('hospitalReviews', 'star_rated')
                ->orderByDesc('hospital_reviews_avg_star_rated')
                ->limit(8)
                ->get();
            // Offers
            $offers = Offer::where('is_active', 1)->whereHas('hospital', function ($q) {
                $q->where('is_active', 1);
            })
                ->where('start_date', '<=', now())
                ->where('end_date', '>=', now())
                ->get();
            $offers = OfferResource::collection($offers);
            // Cats
            $specialities = Speciality::limit(8)->get();
            $specialities = SpecialityResource::collection($specialities);
            // Doctors
            $doctors = User::active()->whereHas('hospital', function ($q) {
                $q->where('is_active', 1);
            })->where('user_type', 'D')->withAvg('reviews', 'star_rated')
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

            // add distance to data
            $lat = request("lat");
            $long = request("long");
            if ($lat != null && $long != null) {
                $hospitals->map(function ($hospital) use ($lat, $long) {
                    if ($hospital?->lat != null && $hospital?->long != null) {
                        $hospital->distance = $this->getDistance($hospital->lat, $hospital->long, $lat, $long) ?? null;
                    } else {
                        $hospital->distance = null;
                    }
                    return $hospital;
                });
                $doctors->map(function ($doctor) use ($lat, $long) {
                    if ($doctor->hospital?->lat != null && $doctor->hospital?->long != null) {
                        $doctor->distance = $this->getDistance($doctor->hospital->lat, $doctor->hospital->long, $lat, $long) ?? null;
                    } else {
                        $doctor->distance = null;
                    }
                    return $doctor;
                });
            }

            // Data
            $data[] = [
                'banners' => $banners ? BannerResource::collection($banners) : [],
                'hospital_types' => $hospital_types,
                'hospitals' => $hospitals ? HospitalResource::collection($hospitals) : [],
                'offers' => $offers,
                'specialities' => $specialities,
                'doctors' => $doctors ? DoctorResource::collection($doctors) : [],
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
            return response()->json(['error' => $validator->errors(), 'status' => 422], 422);
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
            return $this->SuccessResponse(
                200,
                'All States reterieved successfully',
                StateResource::collection($states)
            );
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
            } elseif (!empty($countryIds)) {
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
            return $this->SuccessResponse(
                200,
                'All Cities reterieved successfully',
                CityResource::collection($cities)
            );
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
            return $this->SuccessResponse(
                200,
                "All Insurance reterieved successfully",
                InsuranceResource::collection($insurance)
            );
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
            if ($hospitals_ids) {
                $query->whereHas('users', function ($query) use ($hospitals_ids) {
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
        try {
            $specialityIds = $request->input('speciality_ids') ? json_decode($request->input('speciality_ids')) : [];
            $hospitalIds = $request->input('hospital_ids') ? json_decode($request->input('hospital_ids')) : [];
            /*** 1. Search & Filter Doctors ***/
            $doctors = User::active()->where('user_type', 'D')->whereHas('hospital', function ($q) {
                $q->where('is_active', 1);
            });
            // Speciality Ids
            if ($specialityIds) {
                $doctors = $doctors->whereIn('speciality_id', $specialityIds);
            }
            if ($hospitalIds) {
                $doctors = $doctors->whereIn('hospital_id', $hospitalIds);
            }
            $doctors = $doctors->withAvg('reviews', 'star_rated')
                ->orderByDesc('reviews_avg_star_rated')->get();
            // add distance to data
            $lat = request("lat");
            $long = request("long");
            if ($lat != null && $long != null) {
                $doctors->map(function ($doctor) use ($lat, $long) {
                    if ($doctor->hospital?->lat != null && $doctor->hospital?->long != null) {
                        $doctor->distance = $this->getDistance($doctor->hospital->lat, $doctor->hospital->long, $lat, $long) ?? null;
                    } else {
                        $doctor->distance = null;
                    }
                    return $doctor;
                });
            }
            return $this->SuccessResponse(200,  'Doctor list', DoctorResource::collection($doctors));
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
        try {
            $profile = User::where('users.id', $id)
                ->where('user_type', 'D')
                ->first();
            // add distance to data
            $lat = request("lat");
            $long = request("long");
            if ($lat != null && $long != null) {
                if ($profile->hospital?->lat != null && $profile->hospital?->long != null) {
                    $profile->distance = $this->getDistance($profile->hospital->lat, $profile->hospital->long, $lat, $long) ?? null;
                    $profile->hospital->distance = $profile->distance;
                } else {
                    $profile->distance = null;
                    $profile->hospital->distance = null;
                }
            }
            $profile = $profile ? DoctorProfileResource::make($profile) : null;
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
            if ($request->has("long") && $request->has("lat")) {
                foreach ($hospitals as $hospital) {
                    if ($hospital->lat != null && $hospital->long != null) {
                        $lat = (float)$hospital->lat;
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
                                $hospital['distance'] = round($distanceInKilometers, 2);
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
                    'doctors',
                    'specialities',
                    'offers' => function ($query) {
                        $query->where('is_active', 1)
                            ->where('start_date', '<=', now())
                            ->where('end_date', '>=', now());
                    }
                ])
                ->first();

            $profile->state_id = $profile->state_id ? (int)$profile->state_id : null;
            $profile->city_id = $profile->city_id ? (int)$profile->city_id : null;
            $profile->long = $profile->long ? (float)$profile->long : null;
            $profile->lat = $profile->lat ? (float)$profile->lat : null;
            $profile->hospital_type_id = $profile->hospital_type_id ? (int)$profile->hospital_type_id : null;

            $profile->avg_rating = $profile->avg_rating ? (float)$profile->avg_rating : 0.0;
            $profile->rating_count = $profile->rating_count ? (int)$profile->rating_count : 0;
            // add distance to data
            $lat = request("lat");
            $long = request("long");
            if ($lat != null && $long != null) {
                $profile->doctors->map(function ($doctor) use ($lat, $long) {
                    if ($doctor->hospital?->lat != null && $doctor->hospital?->long != null) {
                        $doctor->distance = $this->getDistance($doctor->hospital->lat, $doctor->hospital->long, $lat, $long) ?? null;
                    } else {
                        $doctor->distance = null;
                    }
                    return $doctor;
                });
            }
            $doctorsList = $profile->doctors ? DoctorResource::collection($profile->doctors) : [];
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
                ->whereHas('hospital', function ($q) {
                    $q->where('is_active', 1);
                })->get();
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
            if ($request->hospital_id) {
                $offers = $offers->where('hospital_id', $request->hospital_id);
            }
            $offers = $offers->whereHas('hospital', function ($q) {
                $q->where('is_active', 1);
            })->get();
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
            $query = Hospital::query()->where('hospitals.is_active', 1);
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
                    // DB::raw("NULL AS distance"),
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
            // add distance to data
            $lat = request("lat");
            $long = request("long");
            if ($lat != null && $long != null) {
                $hospitals->map(function ($hospital) use ($lat, $long) {
                    if ($hospital?->lat != null && $hospital?->long != null) {
                        $hospital['distance'] = $this->getDistance($hospital->lat, $hospital->long, $lat, $long) ?? null;
                    } else {
                        $hospital['distance'] = null;
                    }
                    return $hospital;
                });
            }
            $hospitals = HospitalResource::collection($hospitals);
            if (request('orderBy') == 'distance') {
                $hospitals = $hospitals->sortBy(function ($hospital) {
                    return $hospital['distance'] !== null ? $hospital['distance'] : INF;
                })->values();
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
