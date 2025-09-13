<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\City;
use App\Models\Country;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Hospital;
use App\Models\Review;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    protected  $image_path = 'public/images/';
    public function index()
    {
        if (Auth::user()->is_admin()) {
            return view('admin.profile.index', [
                'admin' => User::find(Auth::id())
            ]);
        } elseif (Auth::user()->is_hospital()) {
            return view('hospital.profile.index', [
                'hospital' => Hospital::query()->where('id', Auth::user()->hospital_id)->get(),
                'hospital_admin' => User::find(Auth::id()),
            ]);
        } elseif (Auth::user()->is_doctor()) {

            // dd(User::find(Auth::id()));

            return view('doctor.profile.index', [
                'doctor' => User::find(Auth::id()),
                'edu_details' => Education::query()->where('user_id', Auth::id())->orderByDesc('id')->get(),
                'experiences' => Experience::query()->where('user_id', Auth::id())->orderByDesc('id')->get(),
            ]);
        } elseif (Auth::user()->is_patient()) {
            return view('patient.profile.index', [
                'patient' => User::find(Auth::id()),
            ]);
        } else {
            abort(401);
        }
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        // dd($id);
        $user = User::find($id);

        $appointments = Appointment::where('patient_id', Auth::id())
            ->where('doctor_id', $id)
            ->get();
        if (Auth::user()->is_doctor() && $user->user_type === 'U') {
            return view('doctor.patient.patient-profile', [
                'patient' => $user
            ]);
        } elseif (Auth::user()->is_patient() && $user->user_type === 'D') {
            $reviews = Review::query()->where('doctor_id', $id)->get();
            $review_sum = Review::where('doctor_id', $id)->sum('star_rated');
            if ($reviews->count() > 0) {
                $review_value = $review_sum / $reviews->count();
            } else {
                $review_value = 0;
            }
            foreach ($appointments as $appointment) {
                if ($appointment->doctor_id == $id) {
                    return view('patient.doctor.profile', [
                        'doctor' => $user,
                        'reviews' => $reviews,
                        'review_value' => $review_value
                    ]);
                } else {
                    abort(401);
                }
            }
        } elseif (Auth::user()->is_hospital()) {
            if ($user->user_type === 'D' && Auth::user()->hospital_id == $user->hospital_id) {
                return view('hospital.doctor.doctor-profile', [
                    'doctor' => $user,
                    'edu_details' => Education::query()->where('user_id', $user->id)->orderByDesc('id')->get(),
                    'experiences' => Experience::query()->where('user_id', $user->id)->orderByDesc('id')->get(),
                ]);
                // && Auth::user()->hospital_id == $user->hospital_id
            } elseif ($user->user_type === 'U') {

                return view('hospital.patient.patient-profile', [
                    'patient' => $user
                ]);
            } else {
                abort(401);
            }
        } else {
            abort(401);
        }
    }

    public function edit($id)
    {
        $user = User::find($id);
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        if (Auth::user()->is_admin()) {
            return view('admin.profile.edit', [
                'admin' => $user,
                'countries' => $countries,
                'states' => $states,
                'cities' => $cities,
            ]);
        } elseif (Auth::user()->is_hospital() && $user->user_type === 'H' && Auth::user()->hospital_id == $user->hospital_id) {
            return view('hospital.profile.edit', [
                'hospital_admin' => $user,
                'countries' => $countries,
                'states' => $states,
                'cities' => $cities,
            ]);
        } elseif (Auth::user()->is_doctor() && $user->user_type === 'D' && Auth::user()->id == $user->id) {
            return view('doctor.profile.edit', [
                'doctor' => $user,
                'countries' => $countries,
                'states' => $states,
                'cities' => $cities,
            ]);
        } elseif (Auth::user()->is_patient() && $user->user_type === 'U' && Auth::user()->id == $user->id) {
            return view('patient.profile.edit', [
                'patient' => $user,
                'countries' => $countries,
                'states' => $states,
                'cities' => $cities,
            ]);
        } else {
            abort(401);
        }
    }

    public function update(Request $request, $id)
    {
        // return $request;
        if (Auth::user()->is_admin() || Auth::user()->is_patient() || Auth::user()->is_hospital() || Auth::user()->is_doctor()) {
            $attributes = $request->validate([
                'name_en' => 'required',
                'name_ar' => 'required',
                'email' => [
                    'required',
                    Rule::unique('users', 'email')->ignore(Auth::user()->id), // 👈 ignore current user's email
                ],
                'username' => 'nullable',
                'profile_image' => 'image',
                'mobile' => 'nullable',
                'description' => 'nullable',
                'date_of_birth' => 'nullable',
                'gender' => 'nullable',
                'age' => 'nullable',
                'address' => 'nullable',
                'state_id' => 'nullable',
                'city_id' => 'nullable',
                'zip_code' => 'nullable',
                'blood_group' => 'nullable',
                'pricing' => 'nullable',
                'twitter' => 'nullable',
                'facebook' => 'nullable',
                'linkedin' => 'nullable',
                'pinterest' => 'nullable',
                'instagram' => 'nullable',
                'youtube' => 'nullable',
            ]);
            if (Auth::user()->is_patient()) {
                $attributes['name_ar'] = $attributes['name_en'];
            }
            if ($attributes['profile_image'] ?? false) {
                if ($file = $request->file('profile_image')) {
                    $filename = time() . '-' . $file->getClientOriginalName();
                    // Storage::disk('local')->put($this->image_path . $filename, $file->getContent());
                    $file->move(public_path('images'), $filename);
                }
                $attributes['profile_image'] = $filename;
                if (Auth::user()->is_hospital()) {
                    Hospital::where('id', Auth::user()->hospital_id)->update(['image' => $attributes['profile_image']]);
                }
            }
            Auth::user()->update($attributes);
            return redirect()->route('profile.index')->with('flash', ['type', 'success', 'message' => 'Profile Updated Successfully']);
        } else {
            abort(401);
        }
    }

    public function destroy($id)
    {
        //
    }
}
