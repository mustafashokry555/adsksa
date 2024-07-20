<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use Illuminate\Http\Request;
use App\Models\Insurance;

class InsuranceController extends Controller
{
    public  function __construct()
    {
        // if(\Auth::user()->user_type =!'H' && \Auth::user()->user_type!='A'){
        //    abort(401);
        // }
    }
    public function index()
    {
        if (\Auth::user()->user_type == 'H') {
            $insurance = Hospital::find(\Auth::user()->hospital_id)->insurances;
            // dd($hospital);
            // $insurance = Insurance::where('user_id', \Auth::user()->hospital_id)->get();
            return view('hospital.insurance.index', compact('insurance'));
        } elseif (\Auth::user()->user_type == 'A') {
            $insurance = Insurance::all();
            return view('admin.insurance.index', compact('insurance'));
        } else {
            abort(401);
        }
    }

    // Show the form for creating a new insurance company
    public function create()
    {
        if (\Auth::user()->user_type == 'H') {
            return view('hospital.insurance.create');
        } elseif (\Auth::user()->user_type == 'A') {
            return view('admin.insurance.create');
        } else {
            abort(401);
        }
    }

    // Store a newly created insurance company in the database
    public function store(Request $request)
    {
        if (\Auth::user()->user_type == 'H' || \Auth::user()->user_type == 'A') {


            $request->validate([
                'name_en' => 'required|string|max:255',
                'name_ar' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                'fax' => 'required|string|max:55',
                'address' => 'required|string|max:255',
                'phone1' => 'required|string|max:20|min:10',
                'phone2' => 'required|string|max:20|min:10',
                'email' => 'required|email|max:255',


            ]);
            $data = $request->all();
            $user = \Auth::user();
            $data['user_id'] = $user->id;
            if ($user->user_type == 'H') {
                $data['user_id'] = $user->hospital_id;
            }
            //  user_id null for admin 
            $store = Insurance::create($data);

            if ($user->user_type == 'H') {
                $hospital = Hospital::find($user->hospital_id);
                $hospital->insurances()->save($store);
            }

            return redirect()->route('insurances.index')
                ->with('flash', ['type', 'success', 'message' => 'Insurance company created successfully.']);
        }
        abort(401);
    }

    // Display the specified insurance company
    // public function show(Insurance $Insurance)
    // {
    //     return view('insurance-companies.show', compact('Insurance'));
    // }

    // Show the form for editing the specified insurance company
    public function edit(Insurance $insurance)
    {
        if (\Auth::user()->user_type == 'H') {
            return view('hospital.insurance.edit', compact('insurance'));
        } elseif (\Auth::user()->user_type == 'A') {
            return view('admin.insurance.edit', compact('insurance'));
        } else {
            abort(401);
        }
    }

    // Update the specified insurance company in the database
    public function update(Request $request, Insurance $Insurance)
    {
        if (\Auth::user()->user_type == 'H' || \Auth::user()->user_type == 'A') {
            $request->validate([
                'name_en' => 'required|string|max:255',
                'name_ar' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                'fax' => 'required|string|max:55',
                'address' => 'required|string|max:255',
                'phone1' => 'required|string|max:20|min:10',
                'phone2' => 'required|string|max:20|min:10',
                'email' => 'required|email|max:255',
            ]);

            $Insurance->update($request->all());

            return redirect()->route('insurances.index')
                ->with('flash', ['type', 'success', 'message' => 'Insurance company updated successfully.']);
        } else {
            abort(401);
        }
    }

    // Remove the specified insurance company from the database
    public function destroy(Insurance $Insurance)
    {
        if (\Auth::user()->user_type == 'H' || \Auth::user()->user_type == 'A') {
            $Insurance->delete();

            return redirect()->route('insurances.index')
                ->with('flash', ['type', 'success', 'message' => 'Insurance company deleted successfully.']);
        }
        abort(401);
    }
}
