<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{


    public function regularAvailabiltiyCreate(Request $request, User $doctor)
    {

        if (\Auth::user()->id !=  $doctor->id) {
            abort(404);
        }
        $weekDay = $request->week_day;
        // if admin
        if (Auth::user()->is_doctor()) {
            return view("doctor.profile.schedule.regular_availability", [
                "doctor" => $doctor,
                "weekDay" => $weekDay
            ]);
        } else {
            abort(401);
        }
    }
    public function regularAvailabiltiySave2(Request $request, User $doctor)
    {
        if (\Auth::user()->id !=  $doctor->id) {
            abort(404);
        }
        if (!Auth::user()->is_doctor()) {
            abort(401);
        }
        $request->validate([
            'days' => 'nullable|array',
            'days.*' => 'in:sunday,monday,tuesday,wednesday,thursday,friday,saturday',
        ]);
        // Selected days from form
        $selectedDays = $request->days ?? [];

        // Existing days in DB
        $existingDays = $doctor->regularAvailabilities()
            ->pluck('week_day')
            ->toArray();
        // Days to delete
        $daysToDelete = array_diff($existingDays, $selectedDays);
        if (!empty($daysToDelete)) {
            $doctor->regularAvailabilities()
                ->whereIn('week_day', $daysToDelete)
                ->delete();
        }
        $daysToCreate = array_diff($selectedDays, $existingDays);
        foreach ($daysToCreate as $day) {
            $doctor->regularAvailabilities()->create([
                'week_day' => $day,
            ]);
        }
        return redirect()->route("profile.index", $doctor->id)->with('flash', ['type', 'success', 'message' => 'Regular Schedule has been created']);
    }
    public function regularAvailabiltiySave(Request $request, User $doctor)
    {
        if (\Auth::user()->id !=  $doctor->id) {
            abort(404);
        }
        if (!Auth::user()->is_doctor()) {
            abort(401);
        }
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


        $doctor->regularAvailabilities()->updateOrCreate(
            ['week_day' => $request->weekDay, 'doctor_id' => $doctor->id],
            $request->except("weekDay")
        );
        return redirect()->route("profile.index", $doctor->id)->with('flash', ['type', 'success', 'message' => 'Regular Schedule has been created']);
    }
    public function regularAvailabiltiyEdit(Request $request, User $doctor)
    {
        if (\Auth::user()?->id !=  $doctor?->id) {
            abort(404);
        }
        if (!Auth::user()->is_doctor()) {
            abort(401);
        }

        $weekDay = $request->week_day;
        $doctor->load(["regularAvailabilities" => function ($query) use ($weekDay) {
            return $query->where("week_day", $weekDay);
        }]);
        // if admin
        return view("doctor.profile.schedule.regular_availability_edit", [
            "doctor" => $doctor,
            "weekDay" => $weekDay
        ]);
        // If hospital

    }
    public function regularAvailabiltiyUpdate(Request $request, User $doctor)
    {
        if (\Auth::user()?->id !=  $doctor?->id) {
            abort(404);
        }
        if (!Auth::user()->is_doctor()) {
            abort(401);
        }
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
        // if admin


        $doctor->regularAvailabilities()
            ->where(['week_day' => $request->weekDay, 'doctor_id' => $doctor->id])
            ->update($request->except("weekDay", "_token"));
        return redirect()->route("profile.index", $doctor->id)->with('flash', ['type', 'success', 'message' => 'Regular Schedule has been updated']);
    }

    public function regularAvailabiltiyDestroy(Request $request, User $doctor)
    {
        if (\Auth::user()?->id !=  $doctor?->id) {
            abort(404);
        }
        // if admin
        if (!Auth::user()->is_doctor()) {
            abort(401);
        }
        // If hospital
        $availability = $doctor->regularAvailabilities()
            ->where(['week_day' => $request->week_day, 'doctor_id' => $doctor->id])
            ->delete();
        return redirect()->route("profile.index", $doctor->id)->with('flash', ['type', 'success', 'message' => 'Regular Schedule has been deleted']);
    }
    // OneTime Availability
    public function oneTimeAvailabiltiyCreate(Request $request, User $doctor)
    {
        if (\Auth::user()?->id !=  $doctor?->id) {
            abort(404);
        }
        if (!Auth::user()->is_doctor()) {
            abort(401);
        }


        return view("doctor.profile.schedule.onetime_availability", [
            // "hospital" => $hospital,
            "doctor" => $doctor,
        ]);
    }
    public function oneTimeAvailabiltiySave(Request $request, User $doctor)
    {
        if (\Auth::user()?->id !=  $doctor?->id) {
            abort(404);
        }
        if (!Auth::user()->is_doctor()) {
            abort(401);
        }
        $request->validate([
            "date" => ["required", "date"],
            "time_interval" => ["required"],
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
        $date = Date("Y-m-d", strtotime($request->date));
        $request->merge([
            "date" => $date,
        ]);



        $doctor->oneTimeailabilities()->updateOrCreate(
            ['date' => $date, 'doctor_id' => $doctor->id],
            $request->except("_token")
        );
        return redirect()->route("profile.index", $doctor->id)->with('flash', ['type', 'success', 'message' => 'OneTime Schedule has been created']);
    }
    public function oneTimeAvailabiltiyEdit(Request $request, User $doctor, $date)
    {
        if (\Auth::user()?->id !=  $doctor?->id) {
            abort(404);
        }
        if (!Auth::user()->is_doctor()) {
            abort(401);
        }
        $date = date("Y-m-d", strtotime($request->date));
        // if admin


        return view("doctor.profile.schedule.onetime_availability_edit", [
            // "hospital" => $hospital,
            "doctor" => $doctor,
            "date" => $date
        ]);
    }
    public function oneTimeAvailabiltiyUpdate(Request $request, User $doctor, $date)
    {
        if (\Auth::user()?->id !=  $doctor?->id) {
            abort(404);
        }
        if (!Auth::user()->is_doctor()) {
            abort(401);
        }
        $request->validate([
            "date" => ["required", "date"],
            "time_interval" => ["required"],
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
        $newdate = Date("Y-m-d", strtotime($request->date));
        $request->merge([
            "date" => $newdate,
        ]);


        $doctor->oneTimeailabilities()
            ->where(['date' => $date, 'doctor_id' => $doctor->id])
            ->update($request->except("_token"));
        return redirect()->route("profile.index", $doctor->id)->with('flash', ['type', 'success', 'message' => 'OneTime Schedule has been updated']);
    }

    public function oneTimeAvailabiltiyDestroy(Request $request, User $doctor, $date)
    {
        if (\Auth::user()?->id !=  $doctor?->id) {
            abort(404);
        }
        if (!Auth::user()->is_doctor()) {
            abort(401);
        }
        // if admin
        $onetimeAvailability = $doctor->oneTimeailabilities()
            ->where(['date' => $date, 'doctor_id' => $doctor->id])
            ->delete();
        return redirect()->route("profile.index", $doctor->id)->with('flash', ['type', 'danger', 'message' => 'OneTime Schedule has been deleted']);
    }

    // Unavailability
    public function unAvailabiltiyCreate(Request $request, User $doctor)
    {
        if (\Auth::user()?->id !=  $doctor?->id) {
            abort(404);
        }
        if (!Auth::user()->is_doctor()) {
            abort(401);
        }

        return view("doctor.profile.schedule.unavailability", [
            // "hospital" => $hospital,
            "doctor" => $doctor,
        ]);
    }
    public function unAvailabiltiySave(Request $request, User $doctor)
    {
        if (\Auth::user()?->id !=  $doctor?->id) {
            abort(404);
        }
        if (!Auth::user()->is_doctor()) {
            abort(401);
        }

        $request->validate([
            "date" => ["required", "date"],
        ]);
        $date = Date("Y-m-d", strtotime($request->date));
        $request->merge([
            "date" => $date,
        ]);
        // if admin

        $doctor->load("unavailailities");

        $doctor->unavailailities()->updateOrCreate(
            ['date' => $date, 'doctor_id' => $doctor->id],
            $request->except("_token")
        );
        return redirect()->route("profile.index", $doctor->id)->with('flash', ['type', 'success', 'message' => 'Unavailability has been created']);
    }
    public function unAvailabiltiyEdit(Request $request, User $doctor, $date)
    {
        if (\Auth::user()?->id !=  $doctor?->id) {
            abort(404);
        }
        if (!Auth::user()->is_doctor()) {
            abort(401);
        }
        $date = date("Y-m-d", strtotime($request->date));
        $doctor->load(["unavailailities" => function ($query) use ($date) {
            return $query->where("date", $date);
        }]);

        // if admin


        return view("doctor.profile.schedule.unavailability_edit", [
            "doctor" => $doctor,
            "date" => $date
        ]);
    }
    public function unAvailabiltiyUpdate(Request $request, User $doctor, $date)
    {
        if (\Auth::user()?->id !=  $doctor?->id) {
            abort(404);
        }
        if (!Auth::user()->is_doctor()) {
            abort(401);
        }
        $request->validate([
            "date" => ["required", "date"],
        ]);
        $newdate = Date("Y-m-d", strtotime($request->date));
        $request->merge([
            "date" => $newdate,
        ]);

        // if admin

        $doctor->unavailailities()
            ->where(['date' => $date, 'doctor_id' => $doctor->id])
            ->update($request->except("_token"));
        return redirect()->route("profile.index", $doctor->id)->with('flash', ['type', 'success', 'message' => 'Unavailability has been updated']);
    }

    public function unAvailabiltiyDestroy(Request $request, User $doctor, $date)
    {
        if (\Auth::user()?->id !=  $doctor?->id) {
            abort(404);
        }
        if (!Auth::user()->is_doctor()) {
            abort(401);
        }
        // If hospital

        $unavailability = $doctor->unavailailities()
            ->where(['date' => date("Y-m-d", strtotime($date)), 'doctor_id' => $doctor->id])
            ->delete();
        return redirect()->route("profile.index", $doctor->id)->with('flash', ['type', 'danger', 'message' => 'Unavailability has been deleted']);
    }
}
