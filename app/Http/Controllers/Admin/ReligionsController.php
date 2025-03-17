<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Religion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReligionsController extends Controller
{
    protected $image_path = 'public/images/';

    public function index(Request $request)
    {
        if (Auth::user()->is_admin()) {
            $religions = Religion::all();
            return view('admin.religions.index', [
                'religions' => $religions,
            ]);
        } else {
            abort(401);
        }
    }

    public function create()
    {
        if (Auth::user()->is_admin()) {
            return view('admin.religions.create');
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
            ]);
            Religion::create($attributes);
            return redirect()
                ->route('religions.index')
                ->with('flash', ['type', 'success', 'message' => 'Religion Added Successfully.']);
        }else{
            abort(401);
        }
    }


    public function edit($id)
    {
        if (Auth::user()->is_admin()) {
            return view('admin.religions.edit', [
                'religion' => Religion::find($id),
            ]);
        }else {
            abort(401);
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->is_admin()) {

            if ($religion = Religion::find($id)) {
                $attributes = $request->validate([
                    'name_ar' => 'required',
                    'name_en' => 'required',
                ]);
                $religion->update($attributes);

                return redirect()
                    ->route('religions.index')
                    ->with('flash', ['type', 'success', 'message' => 'Religion Updated Successfully.']);
            }
        }else{
            abort(401);
        }
    }

    public function destroy($id)
    {
        if(Auth::user()->is_admin()){

            $religion = Religion::find($id);
            $religion->delete();
            
            return redirect()
            ->route('religions.index')
            ->with('flash', ['type', 'success', 'message' => 'Religion Deleted Successfuly']);
        }else{
            abort(401);
        }
    }
}
