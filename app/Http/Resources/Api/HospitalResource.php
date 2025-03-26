<?php

namespace App\Http\Resources\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Http;
use Laravel\Sanctum\PersonalAccessToken;

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
        if(request()->has("long") && request()->has("lat")){
            if($this->lat != null && $this->long != null){
                $distance = $this->getDistance($this->lat, $this->long) ?? null;
            }
        }        
        
        return [
            'id' => $this->id,
            'hospital_name' => $this->hospital_name,
            'hospital_type_id' => $this->hospitalType ? $this->hospitalType->id : null,
            'hospital_type_name' => $this->hospitalType ? $this->hospitalType->name : null,
            'avg_rating' =>  $this->avg_rating,
            'rating_count' =>  $this->rating_count,
            'image' => $this->image,
            'country' => $this->country ? $this->country->name : null,
            'state' => $this->state ? $this->state->name : null,
            'city' => $this->city ? $this->city->name : null,
            'lat' => $this->lat,
            'long' => $this->long,
            'location' => $this->location,
            'distance' => $distance,
            'images_links' => $this->images_links,
            'is_favorite' => $user ? $user->isFavoriteHospital($this->id) : false,
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
