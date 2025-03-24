<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Http;

class HospitalResource extends JsonResource
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
            if($this->lat != null && $this->long != null){
                $distance = $this->getDistance($this->lat, $this->long) ?? null;
            }
        }        
        
        return [
            'id' => $this->id,
            'hospital_name' => $this->hospital_name,
            'hospital_type_id' => $this->hospital_type_id,
            'hospital_type_name' => $this->hospital_type_name,
            'avg_rating' =>  $this->avg_rating,
            'image' => $this->image,
            'state' => $this->state,
            'lat' => $this->lat,
            'long' => $this->long,
            'location' => $this->location,
            'distance' => $distance,
            'city_name' => $this->city_name ?? '',
            'country_name' => $this->country_name ?? '',
            'images_links' => $this->images_links,
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
