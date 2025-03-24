<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\SpecialityResource;
use App\Models\Area;
use App\Models\City;
use App\Models\Country;
use App\Models\Insurance;
use App\Models\Speciality;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    protected $lang;

    public function __construct(Request $request)
    {
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

            // get Cities
            $cities = City::query();
            if (request('country_ids')) {
                $cities = $cities->whereIn("country_id", request('country_ids'));
            }
            $cities = $cities->orderBy("name_$this->lang", 'ASC')->get();

            // get Areas
            $areas = Area::query();
            if (request('city_ids')) {
                $areas = $areas->whereIn("city_id", request('city_ids'));
            } elseif (request('country_ids')) {
                $areas = $areas->whereHas('country', function ($query) {
                    $query->whereIn('countries.id', request('country_ids'));
                });
            }
            $areas = $areas->orderBy("name_$this->lang", 'ASC')->get();

            $data = [
                'specialities' => $specialities,
                'insurance' => $insurance,
                'countries' => $countries,
                'cities' => $cities,
                'areas' => $areas,
            ];
            
            return $this->SuccessResponse(200, 'All Data for the Filter reterieved successfully', $data);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }
}
