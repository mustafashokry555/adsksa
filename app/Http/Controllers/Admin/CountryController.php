<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::withTrashed()->get(); // Include soft-deleted records
        return view('admin.country.index', compact('countries'));
    }

    public function create()
    {
        return view('admin.country.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:countries,code',
        ]);

        Country::create($request->all());

        return redirect()->route('countries.index')->with('flash', ['type', 'success', 'message' => 'Country Created successfully.']);;
    }

    public function show(Country $country)
    {
        // return view('countries.show', compact('country'));
    }

    public function edit(Country $country)
    {
        return view('admin.country.edit', compact('country'));
    }

    public function update(Request $request, Country $country)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'code' => "required|string|max:10|unique:countries,code,{$country->id}",
        ]);

        $country->update($request->all());

        return redirect()->route('countries.index')->with('flash', ['type', 'success', 'message' => 'Country updated successfully.']);
    }

    public function destroy(Country $country)
    {
        $country->delete();

        return redirect()->route('countries.index')
        ->with('flash', ['type', 'success', 'message' => 'Country deleted successfully.']);
    }

    public function restore($id)
    {
        Country::onlyTrashed()->find($id)->restore();

        return redirect()->route('countries.index')
        ->with('flash', ['type', 'success', 'message' => 'Country restored successfully.']);
    }

    public function forceDelete($id)
    {
        Country::onlyTrashed()->find($id)->forceDelete();

        return redirect()->route('countries.index')
        ->with('flash', ['type', 'success', 'message' => 'Country permanently deleted.']);
    }
}
