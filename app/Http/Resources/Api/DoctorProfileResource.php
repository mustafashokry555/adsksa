<?php

namespace App\Http\Resources\Api;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Laravel\Sanctum\PersonalAccessToken;

class DoctorProfileResource extends JsonResource
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
            if($this->hospital?->lat != null && $this->hospital?->long != null){
                $distance = $this->getDistance($this->hospital->lat, $this->hospital->long) ?? null;
            }
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'profile_image' => $this->profile_image,
            'avg_rate' => $this->avg_rate ? (float)$this->avg_rate : $this->avg_rate,
            'reviews_count' => (int)$this->rating_count,
            'is_favorite' => $user ? $user->isFavoriteDoctor($this->id) : false,
            'gender' => $this->gender,
            'pricing' => $this->pricing ? (float)$this->pricing : $this->pricing,
            'distance' => $distance,
            'hospital_id' => $this->hospital_id,
            'speciality_id' => $this->speciality_id,
            'hospital' => $this->hospital ? HospitalResource::make($this->hospital) : null,
            'speciality' => $this->speciality ? [
                'id' => $this->speciality->id,
                'name' => $this->speciality->name,
            ] : null,
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
