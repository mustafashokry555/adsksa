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
    public function addDoctorToWishlist(Request $request){
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

    public function addHospitalToWishlist(Request $request){
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
    public function doctor_wishlist(Request $request){
        $doctorsIds = $request->user()->favoriteDoctors->pluck('doctor_id');
        $doctors = User::whereIn('id', $doctorsIds)->where('user_type', User::DOCTOR)
        ->get();
        $doctors = DoctorResource::collection($doctors);
        return $this->SuccessResponse(200, 'Doctors Wishlist Data', $doctors);
    }

    public function hospital_wishlist(Request $request){

        $hospitalsIds = $request->user()->favoriteHospitals->pluck('hospital_id');
        // return $hospitalsIds;
        $hospitals = Hospital::whereIn('id', $hospitalsIds)->get();
        $hospitals = HospitalResource::collection($hospitals);
        return $this->SuccessResponse(200, 'Hospitals Wishlist Data', $hospitals);
    }

}
