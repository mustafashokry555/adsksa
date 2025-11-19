<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferScheduleController extends Controller
{
    public function regularAvailabiltiyCreate(Request $request, Offer $offer)
    {
        if (!$offer) {
            abort(404);
        }
        $weekDay = $request->week_day;
        // if admin
        if (Auth::user()->is_admin()) {
            return view("admin.offer.schedule.regular_availability", [
                "offer" => $offer,
                "weekDay" => $weekDay
            ]);
        }
        // If hospital
        if (Auth::user()->is_hospital()) {
            if ($offer->hospital_id != Auth::user()->hospital_id) {
                abort(404);
            }

            return view("hospital.offer.schedule.regular_availability", [
                "hospital" => Auth::user()->hospital,
                "offer" => $offer,
                "weekDay" => $weekDay
            ]);
        }
    }
    public function regularAvailabiltiySave(Request $request, Offer $offer)
    {
        $request->validate([
            "time_interval" => ["required"],
            "weekDay" => ["required"],
            "slots" => ["required", "array", "min:1"],
            "slots.*.start_time" => ["required", "date_format:H:i"],
            "slots.*.end_time" => ["required", "date_format:H:i", "after:slots.*.start_time"],
        ], [
            "slots.*.start_time.required" => "Start Time Required",
            "slots.*.start_time.date_format" => "Invalid Time Format, time format is in 24 hours",
            "slots.*.end_time.required" => "End Time Required",
            "slots.*.end_time.date_format" => "Invalid Time Format, time format is in 24 hours",
            "slots.*.end_time.after" => "Invalid End Time, must be greater than start time, time format is in 24 hours",
        ]);
        $request->merge([
            "week_day" => $request->weekDay,
        ]);

        // If hospital
        if (Auth::user()->is_hospital()) {
            if ($offer->hospital_id != Auth::user()->hospital_id) {
                abort(404);
            }
        }
        $offer->regularAvailabilities()->updateOrCreate(
            [
                'week_day' => $request->weekDay,
                'offer_id' => $offer->id,
                'hospital_id' => $offer->hospital->id
            ],
            $request->except("weekDay")
        );
        return redirect()->route("offers.edit", $offer->id)->with('flash', ['type', 'success', 'message' => 'Regular Schedule has been created']);
    }
    public function regularAvailabiltiyEdit(Request $request, Offer $offer)
    {
        if (!$offer) {
            abort(404);
        }
        $weekDay = $request->week_day;
        $offer->load(["regularAvailabilities" => function ($query) use ($weekDay) {
            return $query->where("week_day", $weekDay);
        }]);
        // if admin
        if (Auth::user()->is_admin()) {
            return view("admin.offer.schedule.regular_availability_edit", [
                "offer" => $offer,
                "weekDay" => $weekDay
            ]);
        }
        // If hospital
        if (Auth::user()->is_hospital()) {
            if ($offer->hospital_id != Auth::user()->hospital_id) {
                abort(404);
            }
            return view("hospital.offer.schedule.regular_availability_edit", [
                "hospital" => Auth::user()->hospital,
                "offer" => $offer,
                "weekDay" => $weekDay
            ]);
        }
    }
    public function regularAvailabiltiyUpdate(Request $request, Offer $offer)
    {
        $request->validate([
            "time_interval" => ["required"],
            "weekDay" => ["required"],
            "slots" => ["required", "array", "min:1"],
            "slots.*.start_time" => ["required", "date_format:H:i"],
            "slots.*.end_time" => ["required", "date_format:H:i", "after:slots.*.start_time"],
        ], [
            "slots.*.start_time.required" => "Start Time Required",
            "slots.*.start_time.date_format" => "Invalid Time Format, time format is in 24 hours",
            "slots.*.end_time.required" => "End Time Required",
            "slots.*.end_time.date_format" => "Invalid Time Format, time format is in 24 hours",
            "slots.*.end_time.after" => "Invalid End Time, must be greater than start time, time format is in 24 hours",
        ]);
        $request->merge([
            "week_day" => $request->weekDay,
            'hospital_id' => $offer->hospital->id,
        ]);
        // If hospital
        if (Auth::user()->is_hospital()) {
            if ($offer->hospital_id != Auth::user()->hospital_id) {
                abort(404);
            }
        }

        $offer->regularAvailabilities()
            ->where(['week_day' => $request->weekDay, 'offer_id' => $offer->id])
            ->update($request->except("weekDay", "_token"));
        return redirect()->route("offers.edit", $offer->id)->with('flash', ['type', 'success', 'message' => 'Regular Schedule has been updated']);
    }

    public function regularAvailabiltiyDestroy(Request $request, Offer $offer)
    {

        // If hospital
        if (Auth::user()->is_hospital()) {
            if ($offer->hospital_id != Auth::user()->hospital_id) {
                abort(404);
            }
        }

        $availability = $offer->regularAvailabilities()
            ->where(['week_day' => $request->week_day, 'offer_id' => $offer->id])
            ->delete();
        return redirect()->route("offers.edit", $offer->id)->with('flash', ['type', 'success', 'message' => 'Regular Schedule has been deleted']);
    }

    // Unavailability
    public function unAvailabiltiyCreate(Request $request, Offer $offer)
    {
        if (!$offer) {
            abort(404);
        }

        // if admin
        if (Auth::user()->is_admin()) {
            return view("admin.offer.schedule.unavailability", [
                "offer" => $offer,
            ]);
        }
        // If hospital
        if (Auth::user()->is_hospital()) {
            if ($offer->hospital_id != Auth::user()->hospital_id) {
                abort(404);
            }

            return view("hospital.offer.schedule.unavailability", [
                "hospital" => Auth::user()->hospital,
                "offer" => $offer,
            ]);
        }
    }
    public function unAvailabiltiySave(Request $request, Offer $offer)
    {
        $request->validate([
            "date" => ["required", "date"],
        ]);
        $date = Date("Y-m-d", strtotime($request->date));
        $request->merge([
            "date" => $date,
        ]);
        // If hospital
        if (Auth::user()->is_hospital()) {
            if ($offer->hospital_id != Auth::user()->hospital_id) {
                abort(404);
            }
        }
        $offer->load("unavailailities");

        $offer->unavailailities()->updateOrCreate(
            ['date' => $date, 'offer_id' => $offer->id],
            $request->except("_token")
        );
        return redirect()->route("offers.edit", $offer->id)->with('flash', ['type', 'success', 'message' => 'Unavailability has been created']);
    }
    public function unAvailabiltiyEdit(Request $request, Offer $offer, $date)
    {
        if (!$offer) {
            abort(404);
        }
        $date = date("Y-m-d", strtotime($request->date));
        $offer->load(["unavailailities" => function ($query) use ($date) {
            return $query->where("date", $date);
        }]);

        // if admin
        if (Auth::user()->is_admin()) {
            return view("admin.offer.schedule.unavailability_edit", [
                "offer" => $offer,
                "date" => $date
            ]);
        }
        // If hospital
        if (Auth::user()->is_hospital()) {
            if ($offer->hospital_id != Auth::user()->hospital_id) {
                abort(404);
            }

            return view("hospital.offer.schedule.unavailability_edit", [
                "hospital" => Auth::user()->hospital,
                "offer" => $offer,
                "date" => $date
            ]);
        }
    }
    public function unAvailabiltiyUpdate(Request $request, Offer $offer, $date)
    {
        $request->validate([
            "date" => ["required", "date"],
        ]);
        $newdate = Date("Y-m-d", strtotime($request->date));
        $request->merge([
            "date" => $newdate,
        ]);

        // If hospital
        if (Auth::user()->is_hospital()) {
            if ($offer->hospital_id != Auth::user()->hospital_id) {
                abort(404);
            }
        }
        $offer->unavailailities()
            ->where(['date' => $date, 'offer_id' => $offer->id])
            ->update($request->except("_token"));
        return redirect()->route("offers.edit", $offer->id)->with('flash', ['type', 'success', 'message' => 'Unavailability has been updated']);
    }

    public function unAvailabiltiyDestroy(Request $request, Offer $offer, $date)
    {
        // If hospital
        if (Auth::user()->is_hospital()) {
            if ($offer->hospital_id != Auth::user()->hospital_id) {
                abort(404);
            }
        }
        $unavailability = $offer->unavailailities()
            ->where(['date' => date("Y-m-d", strtotime($date)), 'offer_id' => $offer->id])
            ->delete();
        return redirect()->route("offers.edit", $offer->id)->with('flash', ['type', 'danger', 'message' => 'Unavailability has been deleted']);
    }
}
