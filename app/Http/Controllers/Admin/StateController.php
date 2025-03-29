<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index()
    {
        $states = State::with('country')->withTrashed()->get();
        return view('admin.state.index', compact('states'));
    }

    public function create()
    {
        $countries = Country::all(); // To populate the dropdown for selecting a country
        return view('admin.state.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
        ]);

        State::create($request->all());

        return redirect()->route('states.index')->with('flash', ['type', 'success', 'message' => 'State created successfully.']);
    }

    public function show(State $state)
    {
        // return view('admin.states.show', compact('state'));
    }

    public function edit(State $state)
    {
        $countries = Country::all(); // To allow editing the associated country
        return view('admin.state.edit', compact('state', 'countries'));
    }

    public function update(Request $request, State $state)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
        ]);

        $state->update($request->all());

        return redirect()->route('states.index')->with('flash', ['type', 'success', 'message' => 'State updated successfully.']);
    }

    public function destroy(State $state)
    {
        $state->delete();

        return redirect()->route('states.index')->with('flash', ['type', 'success', 'message' => 'State deleted successfully.']);
    }

    public function restore($id)
    {
        State::onlyTrashed()->find($id)->restore();

        return redirect()->route('states.index')->with('flash', ['type', 'success', 'message' => 'State restored successfully.']);
    }

    public function forceDelete($id)
    {
        State::onlyTrashed()->find($id)->forceDelete();

        return redirect()->route('states.index')->with('flash', ['type', 'success', 'message' => 'State permanently deleted.']);
    }

    public function get_states(Request $request) {
        $states = State::query();
        if ($request->country_id && $request->country_id != null && $request->country_id != 'all') {
            $states = $states->where('country_id', $request->country_id);
        }
        $states = $states->get();

        return response()->json($states);
    }
}
