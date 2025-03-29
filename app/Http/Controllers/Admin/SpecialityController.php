<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
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
            'name_en' => 'required',
            'name_ar' => 'required',
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
                'name_en' => 'required',
                'name_ar' => 'required',
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

    public function get_specialities(Request $request)
    {
        try {
            $hospitals_ids = Hospital::query();
            $query = Speciality::query();
            if (request('state_id')) {
                $hospitals_ids = $hospitals_ids->where('state_id', request('state_id'));
            }
            if (request('insurance_id')) {
                $hospitals_ids = $hospitals_ids->whereHas('insurances', function ($query) {
                    $query->where('insurance_id', request('insurance_id'));
                });
            }
            $hospitals_ids = $hospitals_ids->pluck('id');
            // return $hospitals_ids;
            if($hospitals_ids){
                $query->whereHas('users', function ($query) use ($hospitals_ids){
                    $query->whereIn('hospital_id', $hospitals_ids);
                });
            }
            // if (request('search')) {
            //     $query->where(function ($query) {
            //         $query->where("name_en", 'like', '%' . request('search') . '%')
            //             ->orWhere("name_ar", 'like', '%' . request('search') . '%');
            //     });
            // }
            $speciality = $query->get();
            return response()->json($speciality);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }

}
