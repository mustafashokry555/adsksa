<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

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
        // $products = $this->filterProductsByCategory($request);
        
        return [
            'id' => $this->id,
            'hospital_name' => $this->hospital_name,
            'avg_rating' =>  $this->avg_rating,
            'image' => $this->image,
            'state' => $this->state,
            'lat' => $this->lat,
            'long' => $this->long,
            'location' => $this->location,
            'distance' => $this->avg_rating,
            'city_name' => $this->city_name ?? '',
            'country_name' => $this->country_name ?? '',
            'images_links' => $this->images_links,
        ];
    }

    // private function filterProductsByCategory(Request $request)
    // {
    //     if ($request->filled('category')) {
    //         return $this->products()->where('category_id', $request->category)->get();
    //     }

    //     return $this->products;
    // }
}
