<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\Schedule;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HospitalDoctorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->is_admin()) {
            return view('admin.hospital.doctor.edit', [
                'doctor' => User::find($id),
                'specialities' => Speciality::query()->orderByDesc('id')->get(),
                'hospitals' => Hospital::query()->orderByDesc('id')->get(),
            ]);
        }else{
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
        if(Auth::user()->is_admin()){

            if ($doctor = User::find($id)) {
                $attributes = $request->validate([
                    'name' => 'required',
                    'email' => 'required',
                    'profile_image' => 'image',
                    'user_type' => 'required',
                    'hospital_id' => 'required',
                    'speciality_id' => 'required',
                    'pricing' => 'required',
            ]);
            if ($attributes['profile_image'] ?? false) {
                if ($file = $request->file('profile_image')) {
                    $filename = time() . '-' . $file->getClientOriginalName();
                    // Storage::disk('local')->put($this->image_path. $filename, $file->getContent());
                    $file->move(public_path('images'), $filename);
                }
                $attributes['profile_image'] = $filename;
            }
            $doctor->update($attributes);
        }
        $days = $request->get('days');
        $from = $request->get('from');
        $to = $request->get('to');
        
        foreach ($days as $day) {
            if (!empty($from[$day]) && !empty($to[$day])) {
                Schedule::updateOrCreate([
                    'user_id' => $doctor->id,
                    'day' => $day,
                ], [
                    
                    'from' => $from[$day],
                    'to' => $to[$day]
                ]);
            }
        }
        return redirect()
            ->route('hospital.show', $request->hospital_id)
            ->with('flash', ['type', 'success', 'message' => 'Doctor Updated Successfully']);
        }else{
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
        if(Auth::user()->is_admin()){
            $doctor = User::find($id);
            $doctor->delete();   
            return redirect()->back()->with('flash', ['type', 'success', 'message' => 'Doctor Deleted Successfully']);
        }else{
            abort(401);
        }
    }
}
