<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function help( Request $request ){
        try {
            $data = [];
            $setting = Settings::first();
            if ($setting) {
                $data = [
                    'phone' => $setting->phone,
                    'whatsapp' => "https://wa.me/$setting->phone",
                    'facebook' => $setting->facebook,
                    'instagram' => $setting->instagram,
                ];
            }
            return $this->SuccessResponse(200, 'Data reterieved successfully', $data);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }

    public function privacy_policy( Request $request ){
        try {
            $data = [];
            $setting = Settings::first();
            if ($setting) {
                $data = [
                    'privacy_policy' => $setting->privacy_policy,
                ];
            }
            return $this->SuccessResponse(200, 'Data reterieved successfully', $data);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }

    public function return_policy( Request $request ){
        try {
            $data = [];
            $setting = Settings::first();
            if ($setting) {
                $data = [
                    'return_policy' => $setting->return_policy,
                ];
            }
            return $this->SuccessResponse(200, 'Data reterieved successfully', $data);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }

    // API for Update Or Create App Setting (Done)
    public function updateOrCreateAppSetting(Request $request){
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
}
