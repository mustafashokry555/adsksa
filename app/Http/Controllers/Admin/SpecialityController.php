<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SpecialityController extends Controller
{
    protected  $image_path = 'public/images/';
    public function index(Request $request)
    {
        if (Auth::user()->is_admin()) {

            $orderBy = $request->order;
            $order = $request->sort;

            $query = Speciality::query();
            if (!empty($orderBy) && !empty($order)) {
                $query->orderBy($orderBy, $order);
            } else {
                $query->orderBy('id', 'desc');
            }
            $specialities = $query->get();
            return view('admin.speciality.index', [
                'specialities' => $specialities
            ]);
        } else {
            abort(401);
        }
    }

    public function create()
    {
        if (Auth::user()->is_admin()) {
            return view('admin.speciality.create');
        }else{
            abort(401);
        }
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'image' => 'required|image'
        ]);
        if ($file = $request->file('image')) {
            $filename = time() . '-' . $file->getClientOriginalName();
            // Storage::disk('local')->put($this->image_path . $filename, $file->getContent());
            $file->move(public_path('images'), $filename);
        }
        $attributes['image'] = $filename;

        Speciality::create($attributes);
        return redirect()
            ->route('speciality.index')
            ->with('flash', ['type', 'success', 'message' => 'Speciality added Successfully']);
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        if (Auth::user()->is_admin()) {
            return view(
                'admin.speciality.edit',
                [
                    'speciality' => Speciality::find($id),
                ]
            );
        }else{
            abort(401);
        }
    }


    public function update(Request $request, $id)
    {
        if ($speciality = Speciality::find($id)) {
            $attributes = $request->validate([
                'name' => 'required',
                'image' => 'image'
            ]);

            if ($attributes['image'] ?? false) {
                if ($file = $request->file('image')) {
                    $filename = time() . '-' . $file->getClientOriginalName();
                    // Storage::disk('local')->put($this->image_path . $filename, $file->getContent());
                    $file->move(public_path('images'), $filename);
                }
                $attributes['image'] = $filename;
            }
            $speciality->update($attributes);

            return redirect()
                ->route('speciality.index')
                ->with('flash', ['type', 'success', 'message' => 'Speciality Updated Successfuly']);
        }
    }

    public function destroy($id)
    {
        $speciality = Speciality::find($id);
        $speciality->delete();

        return redirect()
            ->route('speciality.index')
            ->with('flash', ['type', 'success', 'message' => 'Speciality deleted Successfully']);
    }
}
