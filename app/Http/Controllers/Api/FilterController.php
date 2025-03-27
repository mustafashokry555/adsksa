<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\DoctorResource;
use App\Http\Resources\Api\HospitalResource;
use App\Http\Resources\Api\SpecialityResource;
use App\Models\Area;
use App\Models\City;
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

    public function __construct(Request $request){
        $this->lang = $request->header('lang', 'en');
    }

    function filter_data(Request $request) {
        try {
            $data = [];
            // get specialities
            $specialities = Speciality::orderBy("name_$this->lang", 'ASC')->get();
            $specialities = SpecialityResource::collection($specialities);

            // get insurance
            $insurance = Insurance::orderBy("name_$this->lang", 'ASC')->get();

            // get Countries
            $countries = Country::orderBy("name_$this->lang", 'ASC')->get();

            // get states
            $states = City::query();
            if (request('country_ids')) {
                $states = $states->whereIn("country_id", request('country_ids'));
            }
            $states = $states->orderBy("name_$this->lang", 'ASC')->get();

            // get cities
            $cities = Area::query();
            if (request('state_ids')) {
                $cities = $cities->whereIn("city_id", request('state_ids'));
            } elseif (request('country_ids')) {
                $cities = $cities->whereHas('country', function ($query) {
                    $query->whereIn('countries.id', request('country_ids'));
                });
            }
            $cities = $cities->orderBy("name_$this->lang", 'ASC')->get();

            $data = [
                'specialities' => $specialities,
                'insurance' => $insurance,
                'countries' => $countries,
                'states' => $states,
                'cities' => $cities,
            ];
            
            return $this->SuccessResponse(200, 'All Data for the Filter reterieved successfully', $data);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }

    public function search(Request $request){
        // Get filters
        // return $request->state_ids;
        $keyword = $request->input('keyword');
        $specialityIds = $request->input('speciality_ids') ? json_decode($request->input('speciality_ids')) : [];
        $insuranceIds = $request->input('insurance_ids') ? json_decode($request->input('insurance_ids')) : [];
        $countryIds = $request->input('country_ids') ? json_decode($request->input('country_ids')) : [];
        $cityIds = $request->input('state_ids') ? json_decode($request->input('state_ids')) : [];
        $areaIds = $request->input('city_ids') ? json_decode($request->input('city_ids')) : [];
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

            $hospitals = $hospitals->whereHas('specialities', function ($query) use($specialityIds) {
                $query->whereIn('specialities.id', $specialityIds);
            });
        }
        // Location
        if (!empty($areaIds)) {
            $hospitals = $hospitals->whereIn('area_id', $areaIds);

            $doctors = $doctors->whereIn('hospital_id', $hospitals->pluck('id'));
        }elseif (!empty($cityIds)) {
            $hospitals = $hospitals->whereIn('city_id', $cityIds);

            $doctors = $doctors->whereIn('hospital_id', $hospitals->pluck('id'));
        }elseif (!empty($countryIds)){
            $hospitals = $hospitals->whereHas('country', function ($query) use ($countryIds) {
                $query->whereIn('countries.id', $countryIds);
            });

            $doctors = $doctors->whereIn('hospital_id', $hospitals->pluck('id'));
        }
        // Insurance Ids
        if (!empty($insuranceIds)) {
            $hospitalIds = Hospital::whereHas('insurances', function ($query) use ($insuranceIds){
                $query->whereIn('insurance_id', $insuranceIds);
            })->pluck('id');

            $doctors = $doctors->whereIn('hospital_id', $hospitalIds);

            $hospitals = $hospitals->whereIn('id', $hospitalIds);
        }

        // orderBy
        if ($orderBy == 'low_price') {
            $doctors = $doctors->orderBy('pricing', "ASC");
        }elseif($orderBy == 'high_price'){
            $doctors = $doctors->orderBy('pricing', "DESC");
        }

        $doctors = $doctors->get();
        $doctors = collect(DoctorResource::collection($doctors));

        $hospitals = $hospitals->get();
        $hospitals = collect(HospitalResource::collection($hospitals));

        if ($orderBy == 'distance') {
            $hospitals = $hospitals->sortBy(fn($hospital) => $hospital->distance)->values();
            $doctors = $doctors->sortBy(fn($doctor) => $doctor->distance)->values();
        }elseif($orderBy == 'recommend'){
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
