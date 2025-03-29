<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::with('state', 'country')->withTrashed()->get();
        return view('admin.city.index', compact('cities'));
    }

    public function create()
    {
        $countries = Country::all(); // To populate the dropdown for selecting a country
        $states = State::all(); // To populate the dropdown for selecting a country
        return view('admin.city.create', compact('states', 'countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            // 'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:states,id',
        ]);

        City::create($request->all());

        return redirect()->route('cities.index')->with('flash', ['type', 'success', 'message' => 'City created successfully.']);
    }

    public function show(City $city)
    {
        // return view('admin.city.show', compact('city'));
    }

    public function edit(City $city)
    {
        $countries = Country::all(); // To allow editing the associated country
        $states = State::where('country_id', $city->country->id)->get(); // To populate the dropdown for selecting a country
        return view('admin.city.edit', compact('city', 'states', 'countries'));
    }

    public function update(Request $request, City $city)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            // 'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:states,id',
        ]);

        $city->update($request->all());

        return redirect()->route('cities.index')->with('flash', ['type', 'success', 'message' => 'City updated successfully.']);
    }

    public function destroy(City $city)
    {
        $city->delete();

        return redirect()->route('cities.index')->with('flash', ['type', 'success', 'message' => 'City deleted successfully.']);
    }

    public function restore($id)
    {
        City::onlyTrashed()->find($id)->restore();

        return redirect()->route('cities.index')->with('flash', ['type', 'success', 'message' => 'City restored successfully.']);
    }

    public function forceDelete($id)
    {
        City::onlyTrashed()->find($id)->forceDelete();

        return redirect()->route('cities.index')->with('flash', ['type', 'success', 'message' => 'City permanently deleted.']);
    }

    public function get_cities(Request $request) {
        $cities = City::query();
        
        if ($request->state_id && $request->state_id != null && $request->state_id != 'all') {
            $cities = $cities->where('state_id', $request->state_id);
        }elseif ($request->country_id && $request->country_id != null && $request->country_id != 'all') {
            $cities = $cities->whereHas('country', function ($query) use($request) {
                $query->where('countries.id', $request->country_id);
            });
        }
        $cities = $cities->get();

        return response()->json($cities);
    }
}
