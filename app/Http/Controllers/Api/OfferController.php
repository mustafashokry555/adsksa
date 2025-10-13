<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\OfferResource;
use App\Models\FavouriteOffer;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    // All Offers
    public function offers(Request $request)
    {
        try {
            $offers = Offer::where('is_active', 1)
                ->where('start_date', '<=', now())
                ->where('end_date', '>=', now());
            if ($request->hospital_id) {
                $offers = $offers->where('hospital_id', $request->hospital_id);
            }
            $offers = $offers->whereHas('hospital', function ($q) {
                $q->where('is_active', 1);
            })->get();
            $offers = OfferResource::collection($offers);
            return $this->SuccessResponse(200, null, $offers);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }

    public function toggleFavourite(Offer $offer)
    {
        try {
            $user = auth()->user();

            $fav = FavouriteOffer::where('user_id', $user->id)
                ->where('offer_id', $offer->id)
                ->first();

            if ($fav) {
                $fav->delete();
                return $this->SuccessResponse(200, 'Removed from favourites', null);
            }

            FavouriteOffer::create([
                'user_id' => $user->id,
                'offer_id' => $offer->id
            ]);

            return $this->SuccessResponse(200, 'Added to favourites', null);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }

    public function myFavourites()
    {
        try {
            $offers = Offer::whereHas('favourites', function ($q) {
                $q->where('user_id', auth()->id());
            })->get();

            $offers = OfferResource::collection($offers);

            return $this->SuccessResponse(200, null, $offers);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }
}
