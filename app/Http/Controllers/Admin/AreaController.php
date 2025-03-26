<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::with('city', 'country')->withTrashed()->get();
        return view('admin.area.index', compact('areas'));
    }

    public function create()
    {
        $countries = Country::all(); // To populate the dropdown for selecting a country
        $cities = City::all(); // To populate the dropdown for selecting a country
        return view('admin.area.create', compact('cities', 'countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            // 'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
        ]);

        Area::create($request->all());

        return redirect()->route('areas.index')->with('flash', ['type', 'success', 'message' => 'Area created successfully.']);
    }

    public function show(Area $area)
    {
        // return view('admin.city.show', compact('city'));
    }

    public function edit(Area $area)
    {
        $countries = Country::all(); // To allow editing the associated country
        $cities = City::where('country_id', $area->country->id)->get(); // To populate the dropdown for selecting a country
        return view('admin.area.edit', compact('area', 'cities', 'countries'));
    }

    public function update(Request $request, Area $area)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            // 'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
        ]);

        $area->update($request->all());

        return redirect()->route('areas.index')->with('flash', ['type', 'success', 'message' => 'Area updated successfully.']);
    }

    public function destroy(Area $area)
    {
        $area->delete();

        return redirect()->route('areas.index')->with('flash', ['type', 'success', 'message' => 'Area deleted successfully.']);
    }

    public function restore($id)
    {
        Area::onlyTrashed()->find($id)->restore();

        return redirect()->route('areas.index')->with('flash', ['type', 'success', 'message' => 'Area restored successfully.']);
    }

    public function forceDelete($id)
    {
        Area::onlyTrashed()->find($id)->forceDelete();

        return redirect()->route('areas.index')->with('flash', ['type', 'success', 'message' => 'Area permanently deleted.']);
    }

    public function get_cities(Request $request) {
        $cities = Area::query();
        
        if ($request->city_id && $request->city_id != null && $request->city_id != 'all') {
            $cities = $cities->where('city_id', $request->city_id);
        }elseif ($request->country_id && $request->country_id != null && $request->country_id != 'all') {
            $cities = $cities->whereHas('country', function ($query) use($request) {
                $query->where('countries.id', $request->country_id);
            });
        }
        $cities = $cities->get();

        return response()->json($cities);
    }
}
