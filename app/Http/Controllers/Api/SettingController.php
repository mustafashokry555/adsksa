<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
}
