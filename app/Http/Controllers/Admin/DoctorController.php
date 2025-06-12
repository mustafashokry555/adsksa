<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Models\Currency;
use App\Models\DoctorDegree;
use App\Models\Hospital;
use App\Models\Schedule;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Rap2hpoutre\FastExcel\FastExcel;

class DoctorController extends Controller
{
    protected  $image_path = 'public/images/';
    public function index(Request $request)
    {
        if (Auth::user()->is_admin()) {
            $selectedSpecialities = $request->speciality;
            $specialities = Speciality::all();
            $query = User::where('user_type', 'D')->orderByDesc('id');
            if ($selectedSpecialities) {
                $query->whereIn('speciality_id', $selectedSpecialities);
            }
            $doctors = $query->get();
            return view(
                'admin.doctor.index',
                [
                    'doctors' => $doctors,
                    'specialities' => $specialities
                ]
            );
        } elseif (Auth::user()->is_hospital()) {
            return view('hospital.doctor.index', [
                'doctors' => User::query()->where('hospital_id', Auth::user()->hospital_id)->where('user_type', 'D')->orderByDesc('id')->get(),
            ]);
        } else {
            abort(401);
        }
    }

    public function create()
    {
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        $degrees = DoctorDegree::all();
        $currencies = Currency::all();
        if (Auth::user()->is_admin()) {
            return view(
                'admin.doctor.create',
                [
                    'specialities' => Speciality::query()->orderByDesc('id')->get(),
                    'hospitals' => Hospital::query()->orderByDesc('id')->get(),
                    'countries' => $countries,
                    'cities' => $cities,
                    'states' => $states,
                    'degrees' => $degrees,
                    'currencies' => $currencies,
                ]
            );
        } elseif (Auth::user()->is_hospital()) {
            return view('hospital.doctor.create', [
                'specialities' => Speciality::query()->orderByDesc('id')->get(),
                'hospitals' => Hospital::query()->orderByDesc('id')->get(),
                'countries' => $countries,
                'cities' => $cities,
                'states' => $states,
            ]);
        } else {
            abort(401);
        }
    }


    public function store(Request $request)
    {
        if (Auth::user()->is_admin() || Auth::user()->is_hospital()) {

            $attributes = $request->validate([
                'name_ar' => 'required',
                'name_en' => 'required',
                'email' => 'required',
                'profile_image' => 'image',
                'user_type' => 'required',
                'gender' => 'required',
                'degree_id' => 'nullable',
                'currency_id' => 'nullable',
                'address' => 'required',
                'state_id' => 'nullable',
                'city_id' => 'nullable',
                'zip_code' => 'nullable',
                'hospital_id' => 'required',
                'speciality_id' => 'required',
                'pricing' => 'required',
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            if ($attributes['profile_image'] ?? false) {
                if ($file = $request->file('profile_image')) {
                    $filename = time() . '-' . $file->getClientOriginalName();
                    // Storage::disk('local')->put($this->image_path . $filename, $file->getContent());
                    $file->move(public_path('images'), $filename);
                }
                $attributes['profile_image'] = $filename;
            }

            $attributes['password'] = Hash::make($request->password);

            $doctor = User::create($attributes);
            $days = $request->get('days');
            $from = $request->get('from');
            $to = $request->get('to');

            // foreach ($days as $i => $day) {

            //     if (!empty($from[$i]) && !empty($to[$i])) {
            //         Schedule::updateOrCreate([
            //             'user_id' => $doctor->id,
            //             'day' => $day,
            //         ], [
            //             'from' => $from[$i],
            //             'to' => $to[$i]
            //         ]);
            //     }
            // }
            return redirect()
                ->route('doctor.index')
                ->with('flash', ['type', 'success', 'message' => 'Doctor created Successfully']);
        } else {
            abort(401);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $doctor = User::find($id);
        $countries = Country::all();
        if($doctor->country){
            $states = State::where('country_id', $doctor->country->id)->get();
        }else{
            $states = State::all();
        }
        if($doctor->state){
            $cities = City::where('state_id', $doctor->state->id)->get();
        }elseif($doctor->country){
            $cities = City::whereHas('country', function ($query) use($doctor) {
                $query->where('countries.id', $doctor->country->id);
            })->get();
        }else{
            $cities = City::all();
        }
        $degrees = DoctorDegree::all();
        $currencies = Currency::all();
        if (Auth::user()->is_admin()) {
            return view(
                'admin.doctor.edit',
                [
                    'doctor' => $doctor,
                    'specialities' => Speciality::query()->orderByDesc('id')->get(),
                    'hospitals' => Hospital::query()->orderByDesc('id')->get(),
                    'countries' => $countries,
                    'cities' => $cities,
                    'states' => $states,
                    'degrees' => $degrees,
                    'currencies' => $currencies,
                ]
            );
        } elseif (Auth::user()->is_hospital()) {
            return view(
                'hospital.doctor.edit',
                [
                    'doctor' => $doctor,
                    'specialities' => Speciality::query()->orderByDesc('id')->get(),
                    'hospitals' => Hospital::query()->orderByDesc('id')->get(),
                    'countries' => $countries,
                    'cities' => $cities,
                    'states' => $states,
                    'degrees' => $degrees,
                    'currencies' => $currencies,
                ]
            );
        } else {
            abort(401);
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->is_admin() || Auth::user()->is_hospital()) {

            if ($doctor = User::find($id)) {
                $attributes = $request->validate([
                    'name_en' => 'required',
                    'name_ar' => 'required',
                    'email' => 'required',
                    'profile_image' => 'image',
                    'gender' => 'required',
                    'address' => 'required',
                    'state_id' => 'nullable',
                    'city_id' => 'nullable',
                    'degree_id' => 'nullable',
                    'currency_id' => 'nullable',
                    'zip_code' => 'nullable',
                    'user_type' => 'required',
                    'hospital_id' => 'required',
                    'speciality_id' => 'required',
                    'pricing' => 'required',
                    'password' => ['nullable', 'string', 'min:8', 'confirmed'],
                ]);
                if ($attributes['profile_image'] ?? false) {
                    if ($file = $request->file('profile_image')) {
                        $filename = time() . '-' . $file->getClientOriginalName();
                        // Storage::disk('local')->put($this->image_path. $filename, $file->getContent());
                        $file->move(public_path('images'), $filename);
                    }
                    $attributes['profile_image'] = $filename;
                }
                if ($request->password) {
                    $attributes['password'] = Hash::make($request->password);
                } else {
                    unset($attributes['password']);
                }
                $doctor->update($attributes);
            }

            // $days = $request->get('days');
            // $from = $request->get('from');
            // $to = $request->get('to');

            // foreach ($days as $i => $day) {

            //     if (!empty($from[$i]) && !empty($to[$i])) {
            //         Schedule::updateOrCreate([
            //             'user_id' => $doctor->id,
            //             'day' => $day,
            //         ], [
            //             'from' => $from[$i],
            //             'to' => $to[$i]
            //         ]);
            //     }
            // }
            return redirect()
                ->route('doctor.index')
                ->with('flash', ['type', 'success', 'message' => 'Doctor Details updated Successfuylly']);
        } else {
            abort(401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->is_admin() || Auth::user()->is_hospital()) {

            $doctor = User::find($id);
            $doctor->delete();

            return redirect()
                ->route('doctor.index')
                ->with('flash', ['type', 'success', 'message' => 'Doctor Deleted Successfully']);
        } else {
            abort(401);
        }
    }


    public function import(Request $request)
    {
        if (Auth::user()->is_hospital()) {

            $request->validate([
                'file' => 'required|mimes:xlsx,csv,xls',
            ]);

            $file = $request->file('file');
            // $file = $request->file('excel_file');

            // Process the Excel file and register users
            $existingUsers = '';
            (new FastExcel)->import($file, function ($line) {
                // Assuming your Excel file has columns like 'name', 'email', etc.
                $isExist = User::where('email', $line['email'])->first();
                if (!$isExist) {
                    User::create([
                        'name' => $line['name'],
                        'email' => $line['email'],
                        'password' => bcrypt($line['password']),
                        'user_type' => 'D',
                        'gender' => $line['gender'],
                        'hospital_id' => Auth::user()->hospital_id,
                        'username' => $line['username'],
                        'mobile_no' => $line['mobile_no'],
                    ]);
                }
            });
            // if($existingUsers !=''){
            //     $existingUsers = $existingUsers.'Users already exist';
            // }
            return redirect()->route('doctor.index')->with('flash', ['type', 'success', 'message' => 'Excel File Uploaded Successfully' . $existingUsers]);
        }else{
            abort(401);
        }
    }
}
