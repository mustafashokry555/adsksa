<?php

namespace App\Http\Resources\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Http;
use Laravel\Sanctum\PersonalAccessToken;

class DoctorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = null;
        if ($request->user()) {
            $user = $request->user();
        }else{
            $token = request()->bearerToken();
            if ($token) {
                $tokenModel = PersonalAccessToken::findToken($token);
                if ($tokenModel) {
                    $user_id = $tokenModel->tokenable->id;
                    $user = User::find($user_id);
                }
            }
        }
        $distance = null;
        if(request("long") != null && request("lat") != null  ){
            if($this->hospital->lat != null && $this->hospital->long != null){
                $distance = $this->getDistance($this->hospital->lat, $this->hospital->long) ?? null;
            }
        }

        return [
            'id' => $this->id,
            'profile_image' => $this->profile_image,
            'name' => $this->name,
            'speciality_name' => $this->speciality->name,
            'avg_rate' => $this->avg_rate ? (float)$this->avg_rate :$this->avg_rate,
            'distance' => $distance,
            'hospital_name' => $this->hospital->hospital_name,
            'pricing' => $this->pricing ? (float)$this->pricing : $this->pricing,
            'is_favorite' => $user ? $user->isFavoriteDoctor($this->id) : false
        ];
    }

    private function getDistance($lat, $long)
    {
        $hospitalLatitude = (float) $lat;
        $hospitalLongitude = (float) $long;
        $userLatitude = (float) request()->lat;
        $userLongitude = (float) request()->long;

        $earthRadius = 6371; // Earth's radius in kilometers

        // Convert degrees to radians
        $latFrom = deg2rad($userLatitude);
        $longFrom = deg2rad($userLongitude);
        $latTo = deg2rad($hospitalLatitude);
        $longTo = deg2rad($hospitalLongitude);

        // Haversine formula
        $latDelta = $latTo - $latFrom;
        $longDelta = $longTo - $longFrom;

        $a = sin($latDelta / 2) ** 2 +
            cos($latFrom) * cos($latTo) * sin($longDelta / 2) ** 2;

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c; // Distance in kilometers

        return round($distance, 2); // Return the distance rounded to 2 decimal places
    }

}
