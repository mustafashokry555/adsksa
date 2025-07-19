<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

trait GlobalFunctions
{
    protected function getDistance($lat, $long, $lat1, $long1)
    {
        $hospitalLatitude = (float) $lat;
        $hospitalLongitude = (float) $long;
        $userLatitude = (float) $lat1;
        $userLongitude = (float) $long1;

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
