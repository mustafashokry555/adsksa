<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Http;

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
        $distance = null;
        if(request()->has("long") && request()->has("lat")){
            if($this->hospital->lat != null && $this->hospital->long != null){
                $distance = $this->getDistance($this->hospital->lat, $this->hospital->long) ?? null;
            }
        }        
        
        return [
            'id' => $this->id,
            'profile_image' => $this->profile_image,
            'name' => $this->name,
            'speciality_name' => $this->speciality->name,
            'avg_rating' => round($this->reviews()->avg('star_rated'), 2) ?? 0,
            'distance' => $distance,
            'hospital_name' => $this->hospital->hospital_name,
            'is_favorite' => $request->user()->isFavoriteDoctor($this->id)
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
