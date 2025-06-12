<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DoctorDegree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorDegreeController extends Controller
{
        public function index(Request $request)
    {
        if (Auth::user()->is_admin()) {
            $degrees = DoctorDegree::withTrashed()->get();
            return view('admin.docotr_degree.index', [
                'degrees' => $degrees,
            ]);
        } else {
            abort(401);
        }
    }

    public function create()
    {
        if (Auth::user()->is_admin()) {
            return view('admin.docotr_degree.create');
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
                'code_ar' => 'required',
                'code_en' => 'required',
            ]);
            DoctorDegree::create($attributes);
            return redirect()
                ->route('docotr-degree.index')
                ->with('flash', ['type', 'success', 'message' => 'DoctorDegree Added Successfully.']);
        }else{
            abort(401);
        }
    }


    public function edit($id)
    {
        if (Auth::user()->is_admin()) {
            return view('admin.docotr_degree.edit', [
                'docotr_degree' => DoctorDegree::find($id),
            ]);
        }else {
            abort(401);
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->is_admin()) {

            if ($docotr_degree = DoctorDegree::find($id)) {
                $attributes = $request->validate([
                    'name_ar' => 'required',
                    'name_en' => 'required',
                    'code_ar' => 'required',
                    'code_en' => 'required',
                ]);
                $docotr_degree->update($attributes);

                return redirect()
                    ->route('docotr-degree.index')
                    ->with('flash', ['type', 'success', 'message' => 'DoctorDegree Updated Successfully.']);
            }
        }else{
            abort(401);
        }
    }

    public function destroy($id)
    {
        if(Auth::user()->is_admin()){

            $docotr_degree = DoctorDegree::find($id);
            $docotr_degree->delete();

            return redirect()
            ->route('docotr-degree.index')
            ->with('flash', ['type', 'success', 'message' => 'DoctorDegree Deleted Successfuly']);
        }else{
            abort(401);
        }
    }
    public function restore($id)
    {
        DoctorDegree::onlyTrashed()->find($id)->restore();

        return redirect()->route('docotr-degree.index')
        ->with('flash', ['type', 'success', 'message' => 'DoctorDegree restored successfully.']);
    }

    public function forceDelete($id)
    {
        DoctorDegree::onlyTrashed()->find($id)->forceDelete();

        return redirect()->route('docotr-degree.index')
        ->with('flash', ['type', 'success', 'message' => 'DoctorDegree permanently deleted.']);
    }
}
