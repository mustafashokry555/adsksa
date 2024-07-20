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
    }
    /* End Search For Doctors APIs*/
}
