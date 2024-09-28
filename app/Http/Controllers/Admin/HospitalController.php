<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
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
            $insurances = Insurance::select(
                'id',
                DB::raw("IFNULL(name_{$this->getLang()}, name_en) as name")
            )
                ->where('user_id', Auth::id())->get();
            return view('admin.hospital.create', compact('insurances'));
        } else {
            abort(401);
        }
    }
    public function store(Request $request)
    {
        return $request;
        $attributes = $request->validate([
            'hospital_name_en' => 'required',
            'hospital_name_ar' => 'required',
            'image' => 'required|image',
            'address' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'insurance' => 'required',
            'profile_image' => 'image',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);
        if ($file = $request->file('image')) {
            $filename = time() . '-' . $file->getClientOriginalName();
            // Storage::disk('local')->put($this->image_path . $filename, $file->getContent());
            $file->move(public_path('images'), $filename);
        }
        $attributes['image'] = $filename;
        $profileImg = $request['image'] = $filename;

        $attributes['insurance_id'] = $request->insurance;
        $hospital = Hospital::create($attributes);
        $hospital->insurances()->sync($request->insurance);

        User::create([
            'name' => $request->name,
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
        if (Auth::user()->is_admin()) {
            $hospital = Hospital::find($id);
            return view('admin.hospital.edit', [
                'hospital' => $hospital,
                'admin' => User::query()->where('hospital_id', $id)->where('user_type', 'H')->first(),
                'insurances'    =>   Insurance::select(
                    'id',
                    DB::raw("IFNULL(name_{$this->getLang()}, name_en) as name")
                )->get(),
                'selectedInsuranceIds' => $hospital->insurances->pluck('id')->toArray(),
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
        $hospital = Hospital::find($id);
        if ($hospital) {
            $attributes = $request->validate([
                'hospital_name_en' => 'required',
                'hospital_name_ar' => 'required',
                'image' => 'image',
                'address' => 'required',
                'country' => 'required',
                'state' => 'required',
                'city' => 'required',
                'zip' => 'required',
                'insurance' => 'required',
                'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            ]);
            if ($attributes['image'] ?? false) {
                if ($file = $request->file('image')) {
                    $filename = time() . '-' . $file->getClientOriginalName();
                    // Storage::disk('local')->put($this->image_path . $filename , $file->getContent());
                    $file->move(public_path('images'), $filename);
                }
                $attributes['image'] = $filename;
            }
            //  $attributes['insurance_id'] = $request->insurance;
            $hospital->update($attributes);
            if ($admin = User::query()->where('hospital_id', $id)->where('user_type', 'H')->first())
                $data = [
                    'name_en' => $request->hospital_name_en,
                    'name_ar' => $request->hospital_name_ar,
                    'email' => $request->email,
                ];
            if (@$attributes['image']) {
                $data['profile_image'] = $attributes['image'];
            }
            if ($request->password) {
                $data['password'] = Hash::make($request->password);
            }
            $admin->update($data);
            $hospital->insurances()->sync($request->insurance);

            return redirect()
                ->route('hospital.index')
                ->with('flash', ['type', 'success', 'message' => 'Hospital Details updated Successfully']);
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
