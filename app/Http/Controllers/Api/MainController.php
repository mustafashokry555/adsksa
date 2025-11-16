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
use App\Http\Resources\Api\OfferTypeResource;
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
use App\Models\HospitalType;
use App\Models\Notification;
use App\Models\Offer;
use App\Models\OfferType;
use App\Models\Religion;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Laravel\Sanctum\PersonalAccessToken;

class MainController extends Controller
{
    protected $lang;

    public function __construct(Request $request)
    {
        $this->lang = $request->header('lang', 'en');
    }

    // Start Home
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
            // Offers types
            // $offers = Offer::where('is_active', 1)->whereHas('hospital', function ($q) {
            //     $q->where('is_active', 1);
            // })
            // ->where('start_date', '<=', now())
            // ->where('end_date', '>=', now())
            // ->get();
            $offers_type = OfferType::active()->get();
            $offers_type = OfferTypeResource::collection($offers_type);
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
                'offer_types' => $offers_type,
                'specialities' => $specialities,
                'doctors' => $doctors ? DoctorResource::collection($doctors) : [],
                'unread_notification' => $unread_notification,
            ];

            return $this->SuccessResponse(200, null, $data);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }

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
