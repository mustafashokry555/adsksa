<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
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
        if(Auth::user()->is_doctor() || Auth::user()->is_hospital()){
            $user_id = $request->input('user_id');
            return view('doctor.profile.edu-create',['user_id'=>$user_id]);
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
           'college_name' => 'required',
           'area' => 'required',
           'start_date' => 'required|date',
            'end_date' => 'date'
        ]);
        Education::create($attributes);

        return redirect()
            ->route('profile.index')
            ->with('flash', ['type', 'success', 'message' => 'Education added Successfully']);
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
    public function edit(Education $education)
    {
        if(Auth::user()->is_doctor() || Auth::user()->is_hospital()){
            return view('doctor.profile.edu-edit', compact('education'));
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
        if ($education = Education::find($id))
        {
            $attributes = $request->validate([
                'user_id' => 'required',
                'college_name' => 'required',
                'area' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'date'
            ]);
            $education->update($attributes);

            return redirect()
                ->route('profile.index')
                ->with('flash', ['type', 'success', 'message' => 'Education Updated Successfully']);
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
        //
    }
}
