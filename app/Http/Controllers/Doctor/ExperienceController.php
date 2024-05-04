<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
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
    public function create(Request $request)
    {
        if (Auth::user()->is_doctor())
        {
            $user_id = $request->input('user_id');
            return view('doctor.profile.exp-create',['user_id'=>$user_id]);
        }
        elseif(Auth::user()->is_hospital()){
            $user_id = $request->input('user_id');
            return view('doctor.profile.exp-create',['user_id'=>$user_id]);
        }else{
            abort(401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'user_id' => 'required',
            'experience_title' => 'required',
            'company_name' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'date'
        ]);
        Experience::create($attributes);

        return redirect()
            ->route('profile.index')
            ->with('flash', ['type', 'success', 'message' => 'Experience added Successfully']);
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
        if(Auth::user()->is_hospital() || Auth::user()->is_doctor()){

            return view('doctor.profile.exp-edit', [
                'experience' => Experience::find($id)->where('user_id',Auth::user()->id),
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
        if ($experience = Experience::find($id))
        {
            $attributes = $request->validate([
                'user_id' => 'required',
                'experience_title' => 'required',
                'company_name' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'date'
            ]);
            $experience->update($attributes);
        }
        return redirect()
            ->route('profile.index')
            ->with('flash', ['type', 'success', 'message' => 'Experience Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
