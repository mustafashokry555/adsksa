<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Hospital;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class PatientController extends Controller
{
    protected $image_path = 'public/images/';

    public function index(Request $request)
    {
        if (Auth::user()->is_admin()) {

            $status = $request->status;
            $bloodGroups = $request->blood_group;
            $query =  User::where('user_type', 'U')->orderByDesc('id');
            if ($status) {
                $query->whereIn('status', $status);
            }
            if ($bloodGroups) {
                $query->whereIn('blood_group', $bloodGroups);
            }

            $patients = $query->get();
            return view('admin.patient.index', [
                'patients' => $patients,
            ]);
        } elseif (Auth::user()->is_hospital()) {
            return view('hospital.patient.index', [
                'patients' => User::query()
                    ->join('appointments', 'users.id', '=', 'appointments.patient_id')
                    ->where('appointments.hospital_id', Auth::user()->hospital_id)
                    ->select('users.*')
                    ->distinct('users.id') 
                    ->paginate(10),
            ]);
        } elseif (Auth::user()->is_doctor()) {
            // $a = User::query()
            // ->join('appointments', 'users.id', '=', 'appointments.patient_id')
            // ->where('appointments.doctor_id', Auth::id())
            // ->select('users.*')
            // ->distinct()
            // ->paginate(10);
            // dd($a);
            return view('doctor.patient.index', [
                'patients' => User::query()
                    ->join('appointments', 'users.id', '=', 'appointments.patient_id')
                    ->where('appointments.doctor_id', Auth::id())
                    ->select('users.*')
                    ->distinct('users.id') 
                    ->paginate(10),
            ]);
        } else {
            abort(401);
        }
    }

    public function create()
    {
        if (Auth::user()->is_admin()) {
            return view('admin.patient.create', [
                'hospitals' => Hospital::query()->orderByDesc('id')->get(),
            ]);
        } elseif (Auth::user()->is_hospital()) {
            return view('hospital.patient.create');
        } else {
            abort(401);
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->is_admin() || Auth::user()->is_hospital()) {

            $attributes = $request->validate([
                'name' => 'required',
                'email' => 'required',
                'gender' => 'required',
                'user_type' => 'required',
                'status' => 'required',
                // 'pricing' => 'required',
                'profile_image' => 'image',
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'mobile'=>'required|min:10|max:12|unique:users'
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
            User::create($attributes);

            // dd($attributes);
            return redirect()
                ->route('patient.index')
                ->with('flash', ['type', 'success', 'message' => 'Patient Added Successfully.']);
        }else{
            abort(401);
        }
    }


    public function edit($id)
    {
        if (Auth::user()->is_admin()) {
            return view('admin.patient.edit', [
                'patient' => User::find($id),
                'hospitals' => Hospital::query()->orderByDesc('id')->get(),
            ]);
        } elseif (Auth::user()->is_hospital()) {
            return view('hospital.patient.edit', [
                'patient' => User::find($id),
            ]);
        } else {
            abort(401);
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->is_admin() || Auth::user()->is_hospital()) {

            if ($patient = User::find($id)) {
                $attributes = $request->validate([
                    'name' => 'required',
                    'email' => 'required',
                    'gender' => 'required',
                    'user_type' => 'required',
                    'status' => 'required',
                    // 'pricing' => 'required',
                    'profile_image' => 'image',
                    'password' => ['nullable', 'string', 'min:8', 'confirmed'],
                    
                    'mobile'=>'required|min:10|max:12|unique:users,mobile,'.$id,
                    
                ]);
                if ($attributes['profile_image'] ?? false) {
                    if ($file = $request->file('profile_image')) {
                        $filename = time() . '-' . $file->getClientOriginalName();
                        // Storage::disk('local')->put($this->image_path . $filename, $file->getContent());
                        $file->move(public_path('images'), $filename);
                    }
                    $attributes['profile_image'] = $filename;
                }

                // dd($attributes);
                $attributes['user_type'] ='U';
                if ($request->password) {
                    $attributes['password'] = Hash::make($request->password);
                }else{
                    unset($attributes['password']);
                }
                $patient->update($attributes);

                // dd($patient);
                return redirect()
                    ->route('patient.index')
                    ->with('flash', ['type', 'success', 'message' => 'Patient Updated Successfully.']);
            }
        }else{
            abort(401);
        }
    }

    public function destroy($id)
    {
        if(Auth::user()->is_admin()){

            $patient = User::find($id);
            $patient->delete();
            
            return redirect()
            ->route('patient.index')
            ->with('flash', ['type', 'success', 'message' => 'Patient Deleted Successfuly']);
        }else{
            abort(401);
        }
    }
}
