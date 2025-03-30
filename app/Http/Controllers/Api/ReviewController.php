<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\HospitalReview;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    // Review Doctoe
    public function add_doctor_review(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required',
            'star_rated' => 'required|integer|between:0,5',
            'review_title' => 'required',
            'review_body' => 'required|max:100',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => 422]);
        }
        try {
            $doctor = User::where([
                'id' => $request->doctor_id,
                'user_type' => User::DOCTOR,
                // 'hospital_id' => $request->hospital_id,
            ])->first();
            if (!$doctor) {
                return $this->ErrorResponse(400, "Invalid Data");
            }
            $user = $request->user();
            $review = Review::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'doctor_id' => $request->doctor_id,
                ],
                [
                    'star_rated' => $request->star_rated,
                    'review_title' => $request->review_title,
                    'review_body' => $request->review_body,
                    'hospital_id' => $doctor->hospital?->id,
                ]
            );
            return $this->SuccessResponse(200, "Thank You for rating my profile.!", $review);
        } catch (\Throwable $th) {
            // return $th;
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }

    // Review Hospital
    public function add_hospital_review(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hospital_id' => 'required',
            'star_rated' => 'required|integer|between:0,5',
            'review_title' => 'required',
            'review_body' => 'required|max:100',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'errorAr' => $validator->errors(), 'status' => 422]);
        }
        try {
            $hospital = Hospital::where('id', $request->hospital_id)->first();
            if (!$hospital) {
                return $this->ErrorResponse(400, "Invalid Data");
            }
            $user = $request->user();
            $review = HospitalReview::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'hospital_id' => $request->hospital_id,
                ],
                [
                    'star_rated' => $request->star_rated,
                    'review_title' => $request->review_title,
                    'review_body' => $request->review_body,
                ]
            );
            return $this->SuccessResponse(200, "Thank You for rating my profile.!", $review);
        } catch (\Throwable $th) {
            // return $th;
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }
}
