<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\OfferResource;
use App\Http\Resources\Api\OfferTypeResource;
use App\Models\Hospital;
use App\Models\Offer;
use App\Models\OfferType;
use Illuminate\Http\Request;

class OfferTypesController extends Controller
{
    public function offerTypes()
    {
        try {
            // offer types where has offers active
            $offer_types = OfferType::where('status',1)->where( function ($q) {
                $q->whereHas('offers', function ($q2) {
                    $q2->where('is_active', 1)
                        ->where('start_date', '<=', now())
                        ->where('end_date', '>=', now());
                });
            })->get();
            $offer_types = OfferTypeResource::collection($offer_types);
            return $this->SuccessResponse(200, 'Offer Types retrieved successfully', $offer_types);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }

    public function offerTypeDetails($id, Request $request)
    {
        try {
            $offers = Offer::where('is_active', 1)
                ->where('offer_type_id',$id);
            if ($request->has('hospital_id') && !empty($request->hospital_id)) {
                if(Hospital::where('id',$request->hospital_id)->where('is_active', 1)->exists()){
                    $offers = $offers->where('hospital_id',$request->hospital_id);
                }
            }
            $offers = $offers->where('start_date', '<=', now())
                ->where('end_date', '>=', now());
            // if ($request->hospital_id) {
            //     $offers = $offers->where('hospital_id', $request->hospital_id);
            // }
            $offers = $offers->whereHas('hospital', function ($q) {
                $q->where('is_active', 1);
            })->get();
            $offers = OfferResource::collection($offers);
            return $this->SuccessResponse(200, 'Offer retrieved successfully', $offers);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }
}
