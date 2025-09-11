<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\DoctorResource;
use App\Http\Resources\Api\HospitalResource;
use App\Http\Resources\Api\OfferResource;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class HospitalController extends Controller
{
    protected $lang;

    public function __construct(Request $request)
    {
        $this->lang = $request->header('lang', 'en');
    }

    public function hospitalProfile($id){
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
    public function HospitalWithFilter(Request $request)
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

    public function HospitalsTest(Request $request){
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
}
