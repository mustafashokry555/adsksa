<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\DoctorResource;
use App\Http\Resources\Api\HospitalResource;
use App\Models\Hospital;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class WishlistController extends Controller
{
    // add And Delete
    public function addDoctorToWishlist(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id' => [
                'required',
                'integer',
                Rule::exists('users', 'id')->where('user_type', User::DOCTOR),
            ],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $wishlist = Wishlist::Where('patient_id', '=', $request->user()->id)
            ->where('doctor_id', '=', $request->doctor_id)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            return $this->SuccessResponse(200, 'Removed from wishlist!', null);
        }
        Wishlist::insert(
            [
                'doctor_id' => $request->doctor_id,
                'patient_id' => $request->user()->id
            ]
        );
        return $this->SuccessResponse(200, 'Added to wishlist!', null);
    }

    public function addHospitalToWishlist(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hospital_id' => [
                'required',
                'integer',
                Rule::exists('hospitals', 'id'),
            ],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $wishlist = Wishlist::Where('patient_id', '=', $request->user()->id)
            ->where('hospital_id', '=', $request->hospital_id)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            return $this->SuccessResponse(200, 'Removed from wishlist!', null);
        }
        Wishlist::insert(
            [
                'hospital_id' => $request->hospital_id,
                'patient_id' => $request->user()->id
            ]
        );
        return $this->SuccessResponse(200, 'Added to wishlist!', null);
    }

    // get Data
    public function doctor_wishlist(Request $request)
    {
        $doctorsIds = $request->user()->favoriteDoctors->pluck('doctor_id');
        $doctors = User::whereIn('id', $doctorsIds)->where('user_type', User::DOCTOR)
            ->get();
        // add distance to data
        $lat = request("lat");
        $long = request("long");
        if ($lat != null && $long != null) {
            $doctors->map(function ($doctor) use ($lat, $long) {
                if ($doctor->hospital?->lat != null && $doctor->hospital?->long != null) {
                    $doctor->distance = $this->getDistance($doctor->hospital->lat, $doctor->hospital->long, $lat, $long) ?? null;
                } else {
                    $doctor->distance = null;
                }
                return $doctor;
            });
        }
        $doctors = DoctorResource::collection($doctors);
        return $this->SuccessResponse(200, 'Doctors Wishlist Data', $doctors);
    }

    public function hospital_wishlist(Request $request)
    {

        $hospitalsIds = $request->user()->favoriteHospitals->pluck('hospital_id');
        // return $hospitalsIds;
        $hospitals = Hospital::whereIn('id', $hospitalsIds)->get();
        // add distance to data
        $lat = request("lat");
        $long = request("long");
        if ($lat != null && $long != null) {
            $hospitals->map(function ($hospital) use ($lat, $long) {
                if ($hospital?->lat != null && $hospital?->long != null) {
                    $hospital->distance = $this->getDistance($hospital->lat, $hospital->long, $lat, $long) ?? null;
                } else {
                    $hospital->distance = null;
                }
                return $hospital;
            });
        }
        $hospitals = HospitalResource::collection($hospitals);
        return $this->SuccessResponse(200, 'Hospitals Wishlist Data', $hospitals);
    }

    public function wishlist(Request $request)
    {
        // Doctors
        $doctorsIds = $request->user()->favoriteDoctors->pluck('doctor_id');
        $doctors = User::whereIn('id', $doctorsIds)->where('user_type', User::DOCTOR)
            ->get();


        // Hospitals
        $hospitalsIds = $request->user()->favoriteHospitals->pluck('hospital_id');
        $hospitals = Hospital::whereIn('id', $hospitalsIds)->get();
        // add distance to data
        $lat = request("lat");
        $long = request("long");
        if ($lat != null && $long != null) {
            $hospitals->map(function ($hospital) use ($lat, $long) {
                if ($hospital?->lat != null && $hospital?->long != null) {
                    $hospital->distance = $this->getDistance($hospital->lat, $hospital->long, $lat, $long) ?? null;
                } else {
                    $hospital->distance = null;
                }
                return $hospital;
            });
            $doctors->map(function ($doctor) use ($lat, $long) {
                if ($doctor->hospital?->lat != null && $doctor->hospital?->long != null) {
                    $doctor->distance = $this->getDistance($doctor->hospital->lat, $doctor->hospital->long, $lat, $long) ?? null;
                } else {
                    $doctor->distance = null;
                }
                return $doctor;
            });
        }
        $doctors = DoctorResource::collection($doctors);
        $hospitals = HospitalResource::collection($hospitals);

        $data = [
            'doctors' => $doctors,
            'hospitals' => $hospitals
        ];
        return $this->SuccessResponse(200, 'Wishlist Data', $data);
    }
}
