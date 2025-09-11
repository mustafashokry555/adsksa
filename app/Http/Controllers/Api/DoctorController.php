<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\DoctorProfileResource;
use App\Http\Resources\Api\DoctorResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

class DoctorController extends Controller
{
    protected $lang;

    public function __construct(Request $request)
    {
        $this->lang = $request->header('lang', 'en');
    }

    // API for All Doctoes (Done with Out Lang)
    public function DoctorWithFilter(Request $request){
        try {
            $specialityIds = $request->input('speciality_ids') ? json_decode($request->input('speciality_ids')) : [];
            $hospitalIds = $request->input('hospital_ids') ? json_decode($request->input('hospital_ids')) : [];
            /*** 1. Search & Filter Doctors ***/
            $doctors = User::active()->where('user_type', 'D')->whereHas('hospital', function ($q) {
                $q->where('is_active', 1);
            });
            // Speciality Ids
            if ($specialityIds) {
                $doctors = $doctors->whereIn('speciality_id', $specialityIds);
            }
            if ($hospitalIds) {
                $doctors = $doctors->whereIn('hospital_id', $hospitalIds);
            }
            $doctors = $doctors->withAvg('reviews', 'star_rated')
                ->orderByDesc('reviews_avg_star_rated')->get();
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
            return $this->SuccessResponse(200,  'Doctor list', DoctorResource::collection($doctors));
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }

    // Start DoctorProfile API
    public function DoctorProfile($id){
        try {
            $profile = User::where('users.id', $id)
                ->where('user_type', 'D')
                ->first();
            // add distance to data
            $lat = request("lat");
            $long = request("long");
            if ($lat != null && $long != null) {
                if ($profile->hospital?->lat != null && $profile->hospital?->long != null) {
                    $profile->distance = $this->getDistance($profile->hospital->lat, $profile->hospital->long, $lat, $long) ?? null;
                    $profile->hospital->distance = $profile->distance;
                } else {
                    $profile->distance = null;
                    $profile->hospital->distance = null;
                }
            }
            $profile = $profile ? DoctorProfileResource::make($profile) : null;
            return $this->SuccessResponse(200, 'Doctor profile', $profile);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }

    // Start bestsDoctors API
    public function bestsDoctors(Request $request){
        $token = request()->bearerToken();
        $patient_id = null;
        if ($token) {
            $tokenModel = PersonalAccessToken::findToken($token);
            if ($tokenModel) {
                $patient_id = $tokenModel->tokenable->id; // 'tokenable' refers to the user model
            }
        }
        try {
            $doctors = User::leftJoin('reviews', 'reviews.doctor_id', 'users.id')
                ->leftJoin('wishlists', function ($join) use ($patient_id) {
                    $join->on('users.id', '=', 'wishlists.doctor_id')
                        ->where('wishlists.patient_id', '=', $patient_id);
                })
                ->where('users.user_type', '=', 'D')
                ->select(
                    'users.id',
                    'users.name_en',
                    'users.name_ar',
                    DB::raw('AVG(reviews.star_rated) as avg_rating'),
                    DB::raw('COUNT(reviews.id) as reviews_count'),
                    'users.profile_image',
                    DB::raw('IF(wishlists.id IS NOT NULL, TRUE, FALSE) as is_favorited'),
                    'users.gender',
                    'users.pricing',
                    'users.hospital_id',
                    'users.speciality_id',
                )
                ->with([
                    'hospital' => function ($query) {
                        $query->select([
                            'id',
                            'hospital_name_en',
                            'hospital_name_ar',
                            'lat',
                            'long',
                        ]);
                    },
                    'speciality' => function ($query) {
                        $query->select([
                            'id',
                            'name_en',
                            'name_ar',
                        ]);
                    }
                ])
                ->groupBy(
                    'wishlists.id',
                    'users.id',
                    'users.hospital_id',
                    'users.speciality_id',
                    'users.name_en',
                    'users.pricing',
                    'users.gender',
                    'users.name_ar',
                    'users.profile_image'
                )
                ->orderBy('avg_rating', 'DESC')
                ->paginate(12);
            return $this->SuccessResponse(200, 'Doctor profiles by specialty', $doctors);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }

    // Make Complain
    function makeComplaint(Request $request){
        $validator = Validator::make($request->all(), [
            'subject' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email',
            'mobile' => 'required|numeric|digits:9',
            'comment' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => 422], 422);
        }
        try {
            // Create a new row in the table
            $dateTime = Carbon::now();
            $row = DB::table('patient_comments')
                ->insert([
                    "subject" => $request->subject,
                    "name" => $request->name,
                    "mobile" => $request->mobile,
                    "email" => $request->email,
                    "comment" => $request->comment,
                    "created_at" => $dateTime,
                    "updated_at" => $dateTime
                ]);
            return $this->SuccessResponse(200, "Comment Done..", $row);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }

    // Get Doctors by Speciality
    public function SpecialityDoctors($id){
        try {
            $profile = User::join('specialities', 'specialities.id', 'users.speciality_id')
            ->join('hospitals', 'hospitals.id', 'users.hospital_id')
            ->select('users.id', 'users.name', 'users.profile_image', 'specialities.name as speciality_name',
            'users.description', 'specialities.image as speciality_image',
            DB::raw("IFNULL(hospitals.hospital_name_{$this->getLang()}, hospitals.hospital_name_en) as hospital_name"),
            // 'hospitals.hospital_name'
            'hospitals.id as hospital_id')->where('users.speciality_id', $id)->get();

            return $this->SuccessResponse(200, 'Doctor profiles by specialty', $profile);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }
}
