<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Insurance;
use App\Models\Hospital;
use App\Models\Appointment;
use App\Models\Specialization;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\Unavailability;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class MainController extends Controller
{
    protected $lang;

    public function __construct(Request $request)
    {
        $this->lang = $request->header('lang', 'en');
    }
    // API for Update Or Create App Setting (Done)
    public function updateOrCreateAppSetting(Request $request)
    {
        try {
            $request->validate([
                'notifications' => 'nullable|boolean',
                'msg_option' => 'nullable|boolean',
                'call_option' => 'nullable|boolean',
                'video_call_option' => 'nullable|boolean',
            ]);
            $user = $request->user();

            $AppSetting = AppSetting::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'notifications' => $request->notifications ?? '0',
                    'msg_option' => $request->msg_option ?? '0',
                    'call_option' => $request->call_option ?? '0',
                    'video_call_option' => $request->video_call_option ?? '0',
                ]
            );

            return $this->SuccessResponse(200, null, $AppSetting);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }
    /* Start Search For Doctors APIs*/
    // API for All Specialities (Done with Lang)
    public function allSpecialities(Request $request)
    {
        try {
            $query = Speciality::query();
            if (request('search')) {
                $query->where(function ($query) {
                    $query->where("name_en", 'like', '%' . request('search') . '%')
                    ->orWhere("name_ar", 'like', '%' . request('search') . '%');
                });
            }

            $speciality = $query->select(
                'id',
                DB::raw("IFNULL(name_{$this->lang}, name_en) as name"),
                'image'
            )->get();
            // $speciality = $speciality->map(function ($special) {
            //     $special->image = url("api/{$special->image}");
            //     return $special;
            // });
            return $this->SuccessResponse(200, 'All specialities reterieved successfully', $speciality);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }
    // API for All Cities (Done with Lang)
    public function allCities(Request $request)
    {   
        try {
            $query = Hospital::query();
            if (request('search')) {
                $query->where(function ($query) {
                    $query->where("city", 'like', '%' . request('search') . '%');
                });
            }
            $cities = $query->select('city')->groupBy('city')->get();
            return $this->SuccessResponse(200, 'All Cities reterieved successfully', $cities);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }
    // API for All Insurances (Done with Lang)
    public function get_insurances(Request $request)
    {
        try {
            $query = Insurance::query();
            if (request('city')) {
                $hospitals_ids = Hospital::where('city', 'like', '%' . request('city') . '%')
                ->pluck('id');
                $query->whereHas('hospitals', function ($query) use ($hospitals_ids) {
                    $query->whereIn('hospital_id', $hospitals_ids);
                });
            }
            if (request('search')) {
                $query->where(function ($query) {
                    $query->where("name_en", 'like', '%' . request('search') . '%')
                    ->orWhere("name_ar", 'like', '%' . request('search') . '%');
                });
            }
            $insurance = $query->select(
                'id',
                DB::raw("IFNULL(name_{$this->lang}, name_en) as name"),
            )->orderBy('id', 'desc')->get();
            return $this->SuccessResponse(200, "All Insurance reterieved successfully", $insurance);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }
    // API for All Doctoes (Done with Out Lang)
    public function DoctorWithFilter(Request $request)
    {
        $token = request()->bearerToken();
        $patient_id = null;
        if($token){
            $tokenModel = PersonalAccessToken::findToken($token);
            if ($tokenModel) {
                $patient_id = $tokenModel->tokenable->id; // 'tokenable' refers to the user model
            }
        }
        try {
            $hospital_query = Hospital::query();
            if(request('insurance') && !empty(request('insurance'))){
                $hospital_query->whereHas('insurances', function ($query) {
                    $query->where('insurance_id', request('insurance'));
                });    
            }
            if (request('city')) {
                $hospital_query = $hospital_query->where('city', 'like', '%' . request('city') . '%');
            }
            $hospital_ids = $hospital_query->pluck('id');
            $query = User::query();
            if (request('search')) {
                $query->where(function ($query) {
                    $query->where("name", 'like', '%' . request('search') . '%');
                });
            }
            if (request('speciality') && !empty(request('speciality'))) {
                $query->where(function ($query) {
                    $query->where("speciality_id", request('speciality'));
                });
            }

            // Perform the left join with the reviews table
            $query->leftJoin('reviews', 'users.id', '=', 'reviews.doctor_id')
            ->leftJoin('wishlists', function($join) use ($patient_id) {
                $join->on('users.id', '=', 'wishlists.doctor_id')
                    ->where('wishlists.patient_id', '=', $patient_id);
            })
            ->where('user_type', 'D')
            ->whereIn('users.hospital_id', $hospital_ids)
            ->select(
                'users.id',
                DB::raw("IFNULL(users.name_{$this->lang}, users.name_en) as name"),
                'users.profile_image',
                DB::raw('COUNT(reviews.id) as reviews_count'), // Count of reviews
                DB::raw('AVG(reviews.star_rated) as avg_rating'), // Average of ratings
                DB::raw('IF(wishlists.id IS NOT NULL, TRUE, FALSE) as is_favorited'),
                'users.gender',
                'users.pricing',
                'users.hospital_id', // Include hospital_id for the relationship
                'users.speciality_id', // Include speciality_id for the relationship
            )
            ->with([
                'hospital' => function ($query) {
                    $query->select([
                        'id',
                        DB::raw("IFNULL(hospital_name_{$this->lang}, hospital_name_en) as hospital_name"),
                    ]);
                },
                'speciality' => function ($query) {
                    $query->select([
                        'id',
                        DB::raw("IFNULL(name_{$this->lang}, name_en) as speciality_name")
                    ]);
                },
                'hospital.insurances'
            ])
            ->groupBy('wishlists.id', 'users.id', 'users.hospital_id', 'users.speciality_id', 'users.name_en',
                'users.pricing', 'users.gender', 'users.name_ar', 'users.profile_image'); // Group by user fields

            $doctors = $query->get();
            return $this->SuccessResponse(200, 'Doctor list', $doctors);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
        // $keyword = $request->search;
        // $doctors = User::with(['speciality', 'hospital', 'hospital.insurances'])
        // ->where('user_type', 'D')
        // ->where(function ($query) use ($keyword) {
        //     $query->where('name', 'like', '%' . $keyword . '%')
        //         ->orWhere('address', 'like', '%' . $keyword . '%')
        //         ->orWhereHas('hospital', function ($subquery) use ($keyword) {
        //             $subquery->where('hospital_name', 'like', '%' . $keyword . '%');
        //         })
        //         ->orWhereHas('speciality', function ($subquery) use ($keyword) {
        //             $subquery->where('name', 'like', '%' . $keyword . '%');
        //         })
        //         ->orWhereHas('hospital.insurances', function ($subquery) use ($keyword) {
        //             $subquery->where('name_en', 'like', '%' . $keyword . '%')
        //             ->orWhere('name_ar', 'like', '%' . $keyword . '%');
        //         });
        // })
        // ->get();
    }
    /* End Search For Doctors APIs*/
}
