<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CityResource;
use App\Http\Resources\Api\DoctorResource;
use App\Http\Resources\Api\HospitalResource;
use App\Http\Resources\Api\InsuranceResource;
use App\Http\Resources\Api\SpecialityResource;
use App\Http\Resources\Api\StateResource;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Models\Hospital;
use App\Models\Insurance;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class FilterController extends Controller
{
    protected $lang;

    public function __construct(Request $request)
    {
        $this->lang = $request->header('lang', 'en');
    }

    function filter_data(Request $request)
    {
        try {
            $countryIds = $request->input('country_ids') ? json_decode($request->input('country_ids')) : [];
            $stateIds = $request->input('state_ids') ? json_decode($request->input('state_ids')) : [];
            $data = [];
            // get specialities
            $specialities = Speciality::orderBy("name_$this->lang", 'ASC')->get();
            $specialities = SpecialityResource::collection($specialities);

            // get insurance
            $insurance = Insurance::orderBy("name_$this->lang", 'ASC')->get();

            // get Countries
            $countries = Country::orderBy("name_$this->lang", 'ASC')->get();

            // get states
            $states = State::query();
            if (!empty($countryIds)) {
                $states = $states->whereIn('country_id', $countryIds);
            }
            $states = $states->orderBy("name_$this->lang", 'ASC')->get();

            // get cities
            $cities = City::query();
            if (!empty($stateIds)) {
                $cities = $cities->whereIn('state_id', $stateIds);
            } elseif (!empty($countryIds)) {
                $cities = $cities->whereHas('country', function ($query) use ($countryIds) {
                    $query->whereIn('countries.id', $countryIds);
                });
            }
            $cities = $cities->orderBy("name_$this->lang", 'ASC')->get();

            $data = [
                'specialities' => $specialities,
                'insurance' => InsuranceResource::collection($insurance),
                'countries' => $countries,
                'states' => StateResource::collection($states),
                'cities' => CityResource::collection($cities),
            ];

            return $this->SuccessResponse(200, 'All Data for the Filter reterieved successfully', $data);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }

    public function search(Request $request)
    {
        // Get filters
        // return $request->state_ids;
        $keyword = $request->input('keyword');
        $specialityIds = $request->input('speciality_ids') ? json_decode($request->input('speciality_ids')) : [];
        $insuranceIds = $request->input('insurance_ids') ? json_decode($request->input('insurance_ids')) : [];
        $countryIds = $request->input('country_ids') ? json_decode($request->input('country_ids')) : [];
        $stateIds = $request->input('state_ids') ? json_decode($request->input('state_ids')) : [];
        $cityIds = $request->input('city_ids') ? json_decode($request->input('city_ids')) : [];
        $orderBy = $request->input('orderBy');

        /*** 1. Search & Filter Doctors ***/
        $doctors = User::where('user_type', 'D');
        /*** 2. Search & Filter Hospitals ***/
        $hospitals = Hospital::query();
        // Search
        if ($keyword) {
            $doctors = $doctors->where(function ($q) use ($keyword) {
                $q->where('name_en', 'LIKE', "%$keyword%")
                    ->orWhere('name_ar', 'LIKE', "%$keyword%");
            });

            $hospitals = $hospitals->where(function ($q) use ($keyword) {
                $q->where('hospital_name_ar', 'LIKE', "%$keyword%")
                    ->orWhere('hospital_name_en', 'LIKE', "%$keyword%");
            });
        }
        // Speciality Ids
        if ($specialityIds) {
            $doctors = $doctors->whereIn('speciality_id', $specialityIds);

            $hospitals = $hospitals->whereHas('specialities', function ($query) use ($specialityIds) {
                $query->whereIn('specialities.id', $specialityIds);
            });
        }
        // Location
        if (!empty($cityIds)) {
            $hospitals = $hospitals->whereIn('city_id', $cityIds);

            $doctors = $doctors->whereIn('hospital_id', $hospitals->pluck('id'));
        } elseif (!empty($stateIds)) {
            $hospitals = $hospitals->whereIn('state_id', $stateIds);

            $doctors = $doctors->whereIn('hospital_id', $hospitals->pluck('id'));
        } elseif (!empty($countryIds)) {
            $hospitals = $hospitals->whereHas('country', function ($query) use ($countryIds) {
                $query->whereIn('countries.id', $countryIds);
            });

            $doctors = $doctors->whereIn('hospital_id', $hospitals->pluck('id'));
        }
        // Insurance Ids
        if (!empty($insuranceIds)) {
            $hospitalIds = Hospital::whereHas('insurances', function ($query) use ($insuranceIds) {
                $query->whereIn('insurance_id', $insuranceIds);
            })->pluck('id');

            $doctors = $doctors->whereIn('hospital_id', $hospitalIds);

            $hospitals = $hospitals->whereIn('id', $hospitalIds);
        }

        // orderBy
        if ($orderBy == 'low_price') {
            $doctors = $doctors->orderBy('pricing', "ASC");
        } elseif ($orderBy == 'high_price') {
            $doctors = $doctors->orderBy('pricing', "DESC");
        }

        $doctors = $doctors->get();
        $hospitals = $hospitals->get();

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

        if ($orderBy == 'distance') {
            $hospitals = $hospitals->sortBy(fn($h) => $h['distance'] !== null ? $h['distance'] : INF)->values();
            $doctors = $doctors->sortBy(fn($d) => $d['distance'] !== null ? $d['distance'] : INF)->values();
        } elseif ($orderBy == 'recommend') {
            $hospitals = $hospitals->sortByDesc('avg_rating')->values();
            $doctors = $doctors->sortByDesc('avg_rate')->values();
        }

        $doctors = DoctorResource::collection($doctors);
        $hospitals = HospitalResource::collection($hospitals);

        $data = [
            'doctors' => $doctors,
            'hospitals' => $hospitals,
        ];
        return $this->SuccessResponse(200, 'All Data for the Filter reterieved successfully', $data);
    }


    public function search2(Request $request)
    {
        // Get filters
        // return $request->state_ids;
        $keyword = $request->input('keyword');
        $specialityIds = $request->input('speciality_ids') ? json_decode($request->input('speciality_ids')) : [];
        $insuranceIds = $request->input('insurance_ids') ? json_decode($request->input('insurance_ids')) : [];
        $countryIds = $request->input('country_ids') ? json_decode($request->input('country_ids')) : [];
        $stateIds = $request->input('state_ids') ? json_decode($request->input('state_ids')) : [];
        $cityIds = $request->input('city_ids') ? json_decode($request->input('city_ids')) : [];
        $orderBy = $request->input('orderBy');

        /*** 1. Search & Filter Hospitals ***/
        $hospitals = Hospital::query();
        // Search
        if ($keyword) {
            $hospitals = $hospitals->where(function ($q) use ($keyword) {
                $q->where('hospital_name_ar', 'LIKE', "%$keyword%")
                    ->orWhere('hospital_name_en', 'LIKE', "%$keyword%");
            });
        }
        // Speciality Ids
        if ($specialityIds) {
            $hospitals = $hospitals->whereHas('specialities', function ($query) use ($specialityIds) {
                $query->whereIn('specialities.id', $specialityIds);
            });
        }
        // Location
        if (!empty($cityIds)) {
            $hospitals = $hospitals->whereIn('city_id', $cityIds);
        } elseif (!empty($stateIds)) {
            $hospitals = $hospitals->whereIn('state_id', $stateIds);
        } elseif (!empty($countryIds)) {
            $hospitals = $hospitals->whereHas('country', function ($query) use ($countryIds) {
                $query->whereIn('countries.id', $countryIds);
            });
        }
        // Insurance Ids
        if (!empty($insuranceIds)) {
            $hospitals = $hospitals->whereHas('insurances', function ($query) use ($insuranceIds) {
                $query->whereIn('insurance_id', $insuranceIds);
            });
        }

        // Get hospitals
        $hospitals = $hospitals->get();
        $hospitals = collect(HospitalResource::collection($hospitals));

        // Get hospital IDs
        $hospitalIds = $hospitals->pluck('id')->toArray();

        /*** 2. Get Doctors only from those hospitals ***/
        $doctors = User::where('user_type', 'D')
            ->whereIn('hospital_id', $hospitalIds);

        // orderBy
        if ($orderBy == 'low_price') {
            $doctors = $doctors->orderBy('pricing', "ASC");
        } elseif ($orderBy == 'high_price') {
            $doctors = $doctors->orderBy('pricing', "DESC");
        }

        $doctors = $doctors->get();
        $doctors = collect(DoctorResource::collection($doctors));

        if ($orderBy == 'distance') {
            $hospitals = $hospitals->sortBy(fn($hospital) => $hospital->distance)->values();
            $doctors = $doctors->sortBy(fn($doctor) => $doctor->distance)->values();
        } elseif ($orderBy == 'recommend') {
            $hospitals = $hospitals->sortByDesc(fn($hospital) => $hospital->avg_rating)->values();
            $doctors = $doctors->sortByDesc(fn($doctor) => $doctor->avg_rate)->values();
        }

        $data = [
            'doctors' => $doctors,
            'hospitals' => $hospitals,
        ];
        return $this->SuccessResponse(200, 'All Data for the Filter reterieved successfully', $data);
    }
}
