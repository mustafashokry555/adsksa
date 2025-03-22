<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HospitalType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HospitalTypesController extends Controller
{
    protected $image_path = 'public/images/';

    public function index(Request $request)
    {
        if (Auth::user()->is_admin()) {
            $hospital_types = HospitalType::all();
            return view('admin.hospital_types.index', [
                'hospital_types' => $hospital_types,
            ]);
        } else {
            abort(401);
        }
    }

    public function create()
    {
        if (Auth::user()->is_admin()) {
            return view('admin.hospital_types.create');
        }else {
            abort(401);
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->is_admin()) {

            $attributes = $request->validate([
                'name_en' => 'required',
                'name_ar' => 'required',
                'image' => 'required|image',
            ]);
            if ($file = $request->file('image')) {
                $filename = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('images/hospital_types'), $filename);
                $attributes['image'] = $filename;
            }
            HospitalType::create($attributes);
            return redirect()
                ->route('hospital-types.index')
                ->with('flash', ['type', 'success', 'message' => 'Hospital Types Added Successfully.']);
        }else{
            abort(401);
        }
    }


    public function edit($id)
    {
        if (Auth::user()->is_admin()) {
            return view('admin.hospital_types.edit', [
                'hospital_type' => HospitalType::find($id),
            ]);
        }else {
            abort(401);
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->is_admin()) {

            if ($hospital_type = HospitalType::find($id)) {
                $attributes = $request->validate([
                    'name_ar' => 'required',
                    'name_en' => 'required',
                    'image' => 'nullable|image',
                ]);
                if ($attributes['image']) {
                    if ($file = $request->file('image')) {
                        $filename = time() . '-' . $file->getClientOriginalName();
                        $file->move(public_path('images/hospital_types'), $filename);
                    }
                    $attributes['image'] = $filename;
                }
                $hospital_type->update($attributes);

                return redirect()
                    ->route('hospital-types.index')
                    ->with('flash', ['type', 'success', 'message' => 'Hospital Type Updated Successfully.']);
            }
        }else{
            abort(401);
        }
    }

    public function destroy($id)
    {
        if(Auth::user()->is_admin()){

            $hospital_type = HospitalType::find($id);
            $hospital_type->delete();
            
            return redirect()
            ->route('hospital-types.index')
            ->with('flash', ['type', 'success', 'message' => 'Hospital Type Deleted Successfuly']);
        }else{
            abort(401);
        }
    }
}
