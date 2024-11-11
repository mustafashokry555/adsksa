<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BannerController extends Controller
{
    protected  $image_path = 'public/images/';
    public function index(Request $request)
    {
        if (Auth::user()->user_type == 'H') {
            $banners = Hospital::find(Auth::user()->hospital_id)->banners;
            return view('hospital.banner.index', compact('banners'));
        } elseif (Auth::user()->user_type == 'A') {
            $selectedHospitals = $request->hospitals;
            $banners = Banner::orderByDesc('id');
            $hospitals = Hospital::all();
            if ($selectedHospitals) {
                $banners->whereIn('hospital_id', $selectedHospitals);
            }
            $banners = $banners->with('hospital')->get();
            // return $banners;
            return view('admin.banner.index', [
                'banners' => $banners,
                'hospitals' => $hospitals
            ]);
        } else {
            abort(401);
        }
    }

    public function create()
    {
        if (Auth::user()->user_type == 'A') {
            return view(
                'admin.banner.create',
                [
                    'hospitals' => Hospital::query()->orderByDesc('id')->get(),
                ]
            );
        } elseif (Auth::user()->user_type == 'H') {
            return view('hospital.banner.create');
        } else {
            abort(401);
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->user_type == 'A' || Auth::user()->user_type == 'H') {

            $attributes = $request->validate([
                'subject_en' => 'required',
                'subject_ar' => 'required',
                'hospital_id' => 'required',
                'is_active' => 'required|boolean',
                'expired_at' => 'required',
                'image' => 'required|image',
            ]);
            
            if ($attributes['image'] ?? false) {
                if ($file = $request->file('image')) {
                    $filename = time() . '-' . $file->getClientOriginalName();
                    $file->move(public_path('images/banners'), $filename);
                }
                $attributes['image'] = $filename;
            }
            $banner = Banner::create($attributes);

            return redirect()
                ->route('banner.index')
                ->with('flash', ['type', 'success', 'message' => 'Banner created Successfully']);
        } else {
            abort(401);
        }
    }
    

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if (Auth::user()->user_type == 'A') {
            return view(
                'admin.banner.edit',
                [
                    'banner' => Banner::find($id),
                    'hospitals' => Hospital::query()->orderByDesc('id')->get(),
                ]
            );
        } elseif (Auth::user()->user_type == 'H') {
            return view(
                'hospital.banner.edit',
                [
                    'banner' => Banner::find($id),
                ]
            );
        } else {
            abort(401);
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->user_type == 'A' || Auth::user()->user_type == 'H') {

            if ($banner = Banner::find($id)) {
                $attributes = $request->validate([
                    'subject_en' => 'required',
                    'subject_ar' => 'required',
                    'hospital_id' => 'required',
                    'is_active' => 'required|boolean',
                    'expired_at' => 'required',
                    'image' => 'image',
                ]);
                if ($attributes['image'] ?? false) {
                    if ($file = $request->file('image')) {
                        $filename = time() . '-' . $file->getClientOriginalName();
                        $file->move(public_path('images/banners'), $filename);
                    }
                    $attributes['image'] = $filename;
                }
                $banner->update($attributes);
            }
            return redirect()
                ->route('banner.index')
                ->with('flash', ['type', 'success', 'message' => 'Banner Details updated Successfuylly']);
        } else {
            abort(401);
        }
    }

    public function destroy($id)
    {
        if (Auth::user()->user_type == 'A' || Auth::user()->user_type == 'H') {

            $banner = Banner::find($id);
            $banner->delete();

            return redirect()
                ->route('banner.index')
                ->with('flash', ['type', 'success', 'message' => 'Banner Deleted Successfully']);
        } else {
            abort(401);
        }
    }

    // public function import(Request $request)
    // {
    //     if (Auth::user()->is_hospital()) {

    //         $request->validate([
    //             'file' => 'required|mimes:xlsx,csv,xls',
    //         ]);

    //         $file = $request->file('file');
    //         // $file = $request->file('excel_file');

    //         // Process the Excel file and register users
    //         $existingUsers = '';
    //         (new FastExcel)->import($file, function ($line) {
    //             // Assuming your Excel file has columns like 'name', 'email', etc.
    //             $isExist = User::where('email', $line['email'])->first();
    //             if (!$isExist) {
    //                 User::create([
    //                     'name' => $line['name'],
    //                     'email' => $line['email'],
    //                     'password' => bcrypt($line['password']),
    //                     'user_type' => 'D',
    //                     'gender' => $line['gender'],
    //                     'hospital_id' => Auth::user()->hospital_id,
    //                     'username' => $line['username'],
    //                     'mobile_no' => $line['mobile_no'],
    //                 ]);
    //             }
    //         });
    //         // if($existingUsers !=''){
    //         //     $existingUsers = $existingUsers.'Users already exist';
    //         // }
    //         return redirect()->route('doctor.index')->with('flash', ['type', 'success', 'message' => 'Excel File Uploaded Successfully' . $existingUsers]);
    //     }else{
    //         abort(401);
    //     }
    // }
}
