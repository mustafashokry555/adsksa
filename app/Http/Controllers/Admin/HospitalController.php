<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Models\Hospital;
use App\Models\HospitalType;
use App\Models\Speciality;
use App\Models\User;
use App\Models\Insurance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Twilio\Rest\Preview\Sync;

class HospitalController extends Controller
{
    protected  $image_path = 'public/images/';

    public function index(Request $request)
    {
        if (Auth::user()->is_admin()) {

            $orderBy = $request->order;
            $order = $request->sort;

            $query = Hospital::query();
            if (!empty($orderBy) && !empty($order)) {
                $query->orderBy($orderBy, $order);
            } else {
                $query->orderBy('id', 'desc');
            }

            $query->with('users', function ($q) {
                $q->where('user_type', 'H');
            });

            $hospitals = $query->get();
            return view('admin.hospital.index', [
                'hospitals' => $hospitals,

            ]);
        } else {
            abort(401);
        }
    }
    public function create()
    {
        if (Auth::user()->is_admin()) {
            $insurances = Insurance::where('user_id', Auth::id())->get();
            $countries = Country::all();
            $states = State::all();
            $cities = City::all();
            $hospital_types = HospitalType::all();
            // $cities = State::all();
            return view('admin.hospital.create', compact('insurances', 'countries', 'cities', 'states', 'hospital_types'));
        } else {
            abort(401);
        }
    }
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'hospital_name_en' => 'required',
            'hospital_name_ar' => 'required',
            'image' => 'required|image',
            'address' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'hospital_type_id' => 'required',
            'zip' => 'required',
            'lat' => 'required',
            'long' => 'required',
            'location' => 'required',
            'insurance' => 'required',
            'profile_image' => 'image',
            'about_ar' => 'string|nullable',
            'about_en' => 'string|nullable',
            'email' => 'string|nullable',
            'phone' => 'string|nullable',
            'whatsapp' => 'string|nullable',
            'facebook' => 'string|nullable',
            'instagram' => 'string|nullable',
            'tiktok' => 'string|nullable',
            'opening_hours' => 'string|nullable',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'profile_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($file = $request->file('image')) {
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
        }
        $attributes['image'] = $filename;
        $profileImg = $request['image'] = $filename;
        // Handle new image uploads
        if ($request->hasFile('profile_images')) {
            $newImages = [];
            foreach ($request->file('profile_images') as $file) {
                $filename = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('images'), $filename);
                $newImages[] = $filename;
            }
            $attributes['profile_images'] = $newImages;
        }
        $hospital = Hospital::create($attributes);
        $hospital->insurances()->sync($request->insurance);

        User::create([
            'name_en' => $request->name,
            'name_ar' => $request->name,
            'email' => $request->email,
            'profile_image' => $profileImg,
            'user_type' => User::HOSPITAL,
            'hospital_id' => $hospital->id,
            'password' => Hash::make($request->password),

        ]);

        return redirect()
            ->route('hospital.index')
            ->with('flash', ['type', 'success', 'message' => 'Hospital and Admin created Successfully']);
    }

    public function show($id)
    {
        $hospital = Hospital::find($id);
        $specialities = Speciality::all();
        $selectedSpecialities = request()->speciality;
        // $doctors = User::query()->where('user_type', 'D')->where('hospital_id', $hospital->id)->orderByDesc('id')->get();
        $query = User::where('user_type', 'D')->where('hospital_id', $hospital->id)->orderByDesc('id');
        if ($selectedSpecialities) {
            $query->whereIn('speciality_id', $selectedSpecialities);
        }
        $doctors = $query->get();
        return view(
            'admin.hospital.doctor.index',
            [
                'doctors' => $doctors,
                'specialities' => $specialities,
                'id' => $id,
            ]
        );
    }


    public function edit($id)
    {
        $hospital = Hospital::find($id);
        $hospital_types = HospitalType::all();
        $countries = Country::all();
        if($hospital->country){
            $states = State::where('country_id', $hospital->country->id)->get();
        }else{
            $states = State::all();
        }
        if($hospital->state){
            $cities = City::where('state_id', $hospital->state->id)->get();
        }elseif($hospital->country){
            $cities = City::whereHas('country', function ($query) use($hospital) {
                $query->where('countries.id', $hospital->country->id);
            })->get();
        }else{
            $cities = City::all();
        }
        if (Auth::user()->user_type == 'A') {
            return view('admin.hospital.edit', [
                'hospital' => $hospital,
                'admin' => User::query()->where('hospital_id', $id)->where('user_type', 'H')->first(),
                'insurances' => Insurance::get(),
                'selectedInsuranceIds' => $hospital->insurances->pluck('id')->toArray(),
                'hospital_types' => $hospital_types,
                'countries' => $countries,
                'states' => $states,
                'cities' => $cities,
            ]);
        }elseif (Auth::user()->user_type == 'H') {
            return view('hospital.profile.editHospital', [
                'hospital' => $hospital,
                'admin' => User::query()->where('hospital_id', $id)->where('user_type', 'H')->first(),
                'insurances' => Insurance::get(),
                'selectedInsuranceIds' => $hospital->insurances->pluck('id')->toArray(),
                'hospital_types' => $hospital_types,
                'countries' => $countries,
                'states' => $states,
                'cities' => $cities,
            ]);
        } else {
            abort(401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request;
        $hospital = Hospital::find($id);
        if ($hospital) {
            if(Auth::user()->user_type == 'A'){
                $attributes = $request->validate([
                    'hospital_name_en' => 'required',
                    'hospital_name_ar' => 'required',
                    'image' => 'image',
                    'address' => 'required',
                    'city_id' => 'required',
                    'state_id' => 'required',
                    'hospital_type_id' => 'required',
                    'zip' => 'required',
                    'lat' => 'required',
                    'long' => 'required',
                    'location' => 'required',
                    'insurance' => 'required',
                    'profile_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'password' => ['nullable', 'string', 'min:6', 'confirmed'],
                    'email' => 'string|nullable',
                    'phone' => 'string|nullable',
                    'whatsapp' => 'string|nullable',
                    'facebook' => 'string|nullable',
                    'instagram' => 'string|nullable',
                    'tiktok' => 'string|nullable',
                    'about_en' => 'string|nullable',
                    'about_ar' => 'string|nullable',
                    'opening_hours' => 'string|nullable',
                ]);
                $admin = User::where('hospital_id', $id)->where('user_type', 'H')->first();
                if ($admin){
                    $data = [
                        'name_en' => $request->name,
                        'name_ar' => $request->name,
                        'email' => $request->email,
                    ];
                    if ($request->password) {
                        $data['password'] = Hash::make($request->password);
                    }
                    $admin->update($data);
                }else{
                    $data['user_type'] = 'H';
                    $data['hospital_id'] = $id;
                    $data['name_en'] = $request->name;
                    $data['name_ar'] = $request->name;
                    $data['email'] = $request->email;
                    if ($request->password) {
                        $data['password'] = Hash::make($request->password);
                    }
                    $admin = User::create($data);
                }
            }elseif(Auth::user()->user_type == 'H'){
                $attributes = $request->validate([
                    'hospital_name_en' => 'required',
                    'hospital_name_ar' => 'required',
                    'image' => 'image',
                    'address' => 'required',
                    'city_id' => 'required',
                    'state_id' => 'required',
                    'hospital_type_id' => 'required',
                    'zip' => 'required',
                    'lat' => 'required',
                    'long' => 'required',
                    'location' => 'required',
                    'insurance' => 'required',
                    'profile_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'email' => 'string|nullable',
                    'phone' => 'string|nullable',
                    'whatsapp' => 'string|nullable',
                    'facebook' => 'string|nullable',
                    'instagram' => 'string|nullable',
                    'tiktok' => 'string|nullable',
                    'about_en' => 'string|nullable',
                    'about_ar' => 'string|nullable',
                    'opening_hours' => 'string|nullable',
                ]);
            }
            if ($attributes['image'] ?? false) {
                if ($file = $request->file('image')) {
                    $filename = time() . '-' . $file->getClientOriginalName();
                    // Storage::disk('local')->put($this->image_path . $filename , $file->getContent());
                    $file->move(public_path('images'), $filename);
                }
                $attributes['image'] = $filename;
            }
            // Handle image deletion
            if ($request->deletedImages) {
                $deletedKeys = explode(',', rtrim($request->deletedImages, ','));
                $images = $hospital->profile_images;
                foreach ($deletedKeys as $key) {
                    $images = array_values(array_diff($images, [$key]));
                    $imageToDelete = $key;
                    $imagePath = public_path('images/' . $imageToDelete);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
                $hospital->profile_images = array_values($images); // Re-index the array
            }

            // Handle new image uploads
            if ($request->hasFile('profile_images')) {
                $newImages = [];
                $existingImages = $hospital->profile_images ?? [];
                foreach ($request->file('profile_images') as $file) {
                    $filename = time() . '-' . $file->getClientOriginalName();
                    $file->move(public_path('images'), $filename);
                    $newImages[] = $filename;
                }
                $allImages = array_merge($existingImages, $newImages);
                $hospital->profile_images = $allImages;
                // dd($hospital->profile_images);
                $attributes['profile_images'] = $hospital->profile_images;
            }

            $hospital->update($attributes);

            $hospital->insurances()->sync($request->insurance);
            if(Auth::user()->user_type == 'A'){
                return redirect()
                    ->route('hospital.index')
                    ->with('flash', ['type', 'success', 'message' => 'Hospital Details updated Successfully']);
            }else{
                return redirect()
                    ->route('hospital.edit', $id)
                    ->with('flash', ['type', 'success', 'message' => 'Hospital Details updated Successfully']);
            }
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
        $hospital = Hospital::find($id);
        $hospital->delete();

        return redirect()
            ->route('hospital.index');
    }
}
