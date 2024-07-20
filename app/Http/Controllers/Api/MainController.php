<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Appointment;
use App\Models\Hospital;
use App\Models\Specialization;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\Insurance;
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
    // API fro All Specialities (Done with Lang)
    public function allSpecialities()
    {
        try {
            $speciality = Speciality::select(
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
}
