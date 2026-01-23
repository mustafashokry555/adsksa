<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorScheduleController extends Controller
{
    public function regularAvailabiltiyCreate(Request $request, User $doctor)
    {
        if (!$doctor) {
            abort(404);
        }
        $weekDay = $request->week_day;
        // if admin
        if (Auth::user()->is_admin()) {
            return view("admin.doctor.schedule.regular_availability", [
                "doctor" => $doctor,
                "weekDay" => $weekDay
            ]);
        }
        // If hospital
        if (Auth::user()->is_hospital()) {
            $hospital = Auth::user()->load(['doctors' => function ($query) use ($doctor) {
                return $query->where('id', $doctor->id);
            }]);
            if ($hospital->doctors->isEmpty()) {
                abort(404);
            }
            $doctor = $hospital->doctors->first();
            return view("hospital.doctor.schedule.regular_availability", [
                "hospital" => $hospital,
                "doctor" => $doctor,
                "weekDay" => $weekDay
            ]);
        }
    }

    public function regularAvailabiltiySave2(Request $request, User $doctor)
    {
        $request->validate([
            'days' => 'nullable|array',
            'days.*' => 'in:sunday,monday,tuesday,wednesday,thursday,friday,saturday',
        ]);
        // if admin
        if (Auth::user()->is_admin()) {
            $doctor = $doctor;
        }
        // If hospital
        if (Auth::user()->is_hospital()) {
            $hospital = Auth::user()->load(['doctors' => function ($query) use ($doctor) {
                return $query->where('id', $doctor->id);
            }]);
            if ($hospital->doctors->isEmpty()) {
                abort(404);
            }
            $doctor = $hospital->doctors->first();
        }
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
        return redirect()->route("doctor.edit", $doctor->id)->with('flash', ['type', 'success', 'message' => 'Regular Schedule has been created']);
    }
    public function regularAvailabiltiySave(Request $request, User $doctor)
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

        // if admin
        if (Auth::user()->is_admin()) {
            $doctor = $doctor;
        }
        // If hospital
        if (Auth::user()->is_hospital()) {
            $hospital = Auth::user()->load(['doctors' => function ($query) use ($doctor) {
                return $query->where('id', $doctor->id);
            }]);
            if ($hospital->doctors->isEmpty()) {
                abort(404);
            }
            $doctor = $hospital->doctors->first();
        }
        $doctor->regularAvailabilities()->updateOrCreate(
            [
                'week_day' => $request->weekDay,
                'doctor_id' => $doctor->id,
            ],
            $request->except("weekDay")
        );
        return redirect()->route("doctor.edit", $doctor->id)->with('flash', ['type', 'success', 'message' => 'Regular Schedule has been created']);
    }
    public function regularAvailabiltiyEdit(Request $request, User $doctor)
    {
        if (!$doctor) {
            abort(404);
        }
        $weekDay = $request->week_day;
        $doctor->load(["regularAvailabilities" => function ($query) use ($weekDay) {
            return $query->where("week_day", $weekDay);
        }]);
        // if admin
        if (Auth::user()->is_admin()) {
            return view("admin.doctor.schedule.regular_availability_edit", [
                "doctor" => $doctor,
                "weekDay" => $weekDay
            ]);
        }
        // If hospital
        if (Auth::user()->is_hospital()) {
            $hospital = Auth::user()->load(['doctors' => function ($query) use ($doctor) {
                return $query->where('id', $doctor->id);
            }]);
            if ($hospital->doctors->isEmpty()) {
                abort(404);
            }
            return view("hospital.doctor.schedule.regular_availability_edit", [
                "hospital" => $hospital,
                "doctor" => $doctor,
                "weekDay" => $weekDay
            ]);
        }
    }
    public function regularAvailabiltiyUpdate(Request $request, User $doctor)
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
            'hospital_id' => $doctor->hospital->id,
        ]);
        // if admin
        if (Auth::user()->is_admin()) {
            $doctor = $doctor;
        }
        // If hospital
        if (Auth::user()->is_hospital()) {
            $hospital = Auth::user()->load(['doctors' => function ($query) use ($doctor) {
                return $query->where('id', $doctor->id);
            }]);
            if ($hospital->doctors->isEmpty()) {
                abort(404);
            }
            $doctor = $hospital->doctors->first();
        }

        $doctor->regularAvailabilities()
            ->where(['week_day' => $request->weekDay, 'doctor_id' => $doctor->id])
            ->update($request->except("weekDay", "_token"));
        return redirect()->route("doctor.edit", $doctor->id)->with('flash', ['type', 'success', 'message' => 'Regular Schedule has been updated']);
    }

    public function regularAvailabiltiyDestroy(Request $request, User $doctor)
    {
        // if admin
        if (Auth::user()->is_admin()) {
            $doctor = $doctor;
        }
        // If hospital
        if (Auth::user()->is_hospital()) {
            $hospital = Auth::user()->load(['doctors' => function ($query) use ($doctor) {
                return $query->where('id', $doctor->id);
            }]);
            if ($hospital->doctors->isEmpty()) {
                abort(404);
            }
            $doctor = $hospital->doctors->first();
        }

        $availability = $doctor->regularAvailabilities()
            ->where(['week_day' => $request->week_day, 'doctor_id' => $doctor->id])
            ->delete();
        return redirect()->route("doctor.edit", $doctor->id)->with('flash', ['type', 'success', 'message' => 'Regular Schedule has been deleted']);
    }
    // OneTime Availability
    public function oneTimeAvailabiltiyCreate(Request $request, User $doctor)
    {
        if (!$doctor) {
            abort(404);
        }

        // if admin
        if (Auth::user()->is_admin()) {
            return view("admin.doctor.schedule.onetime_availability", [
                "doctor" => $doctor,
            ]);
        }
        // If hospital
        if (Auth::user()->is_hospital()) {
            $hospital = Auth::user()->load(['doctors' => function ($query) use ($doctor) {
                return $query->where('id', $doctor->id);
            }]);
            if ($hospital->doctors->isEmpty()) {
                abort(404);
            }
            $doctor = $hospital->doctors->first();

            return view("hospital.doctor.schedule.onetime_availability", [
                "hospital" => $hospital,
                "doctor" => $doctor,
            ]);
        }
    }
    public function oneTimeAvailabiltiySave(Request $request, User $doctor)
    {
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

        // if admin
        if (Auth::user()->is_admin()) {
            $doctor = $doctor;
        }
        // If hospital
        if (Auth::user()->is_hospital()) {
            $hospital = Auth::user()->load(['doctors' => function ($query) use ($doctor) {
                return $query->where('id', $doctor->id);
            }]);
            if ($hospital->doctors->isEmpty()) {
                abort(404);
            }
            $doctor = $hospital->doctors->first();
        }
        $doctor->oneTimeailabilities()->updateOrCreate(
            ['date' => $date, 'doctor_id' => $doctor->id],
            $request->except("_token")
        );
        return redirect()->route("doctor.edit", $doctor->id)->with('flash', ['type', 'success', 'message' => 'OneTime Schedule has been created']);
    }
    public function oneTimeAvailabiltiyEdit(Request $request, User $doctor, $date)
    {

        if (!$doctor) {
            abort(404);
        }
        $date = date("Y-m-d", strtotime($request->date));
        $doctor->load(["oneTimeailabilities" => function ($query) use ($date) {
            return $query->where("date", $date);
        }]);
        // if admin
        if (Auth::user()->is_admin()) {
            return view("admin.doctor.schedule.onetime_availability_edit", [
                "doctor" => $doctor,
                "date" => $date
            ]);
        }
        // If hospital
        if (Auth::user()->is_hospital()) {
            $hospital = Auth::user()->load(['doctors' => function ($query) use ($doctor) {
                return $query->where('id', $doctor->id);
            }]);
            if ($hospital->doctors->isEmpty()) {
                abort(404);
            }
            return view("hospital.doctor.schedule.onetime_availability_edit", [
                "hospital" => $hospital,
                "doctor" => $doctor,
                "date" => $date
            ]);
        }
    }
    public function oneTimeAvailabiltiyUpdate(Request $request, User $doctor, $date)
    {
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
        // if admin
        if (Auth::user()->is_admin()) {
            $doctor = $doctor;
        }
        // If hospital
        if (Auth::user()->is_hospital()) {
            $hospital = Auth::user()->load(['doctors' => function ($query) use ($doctor) {
                return $query->where('id', $doctor->id);
            }]);
            if ($hospital->doctors->isEmpty()) {
                abort(404);
            }
            $doctor = $hospital->doctors->first();
        }

        $doctor->oneTimeailabilities()
            ->where(['date' => $date, 'doctor_id' => $doctor->id])
            ->update($request->except("_token"));
        return redirect()->route("doctor.edit", $doctor->id)->with('flash', ['type', 'success', 'message' => 'OneTime Schedule has been updated']);
    }

    public function oneTimeAvailabiltiyDestroy(Request $request, User $doctor, $date)
    {
        // if admin
        if (Auth::user()->is_admin()) {
            $doctor = $doctor;
        }
        // If hospital
        if (Auth::user()->is_hospital()) {
            $hospital = Auth::user()->load(['doctors' => function ($query) use ($doctor) {
                return $query->where('id', $doctor->id);
            }]);
            if ($hospital->doctors->isEmpty()) {
                abort(404);
            }
            $doctor = $hospital->doctors->first();
        }
        $onetimeAvailability = $doctor->oneTimeailabilities()
            ->where(['date' => $date, 'doctor_id' => $doctor->id])
            ->delete();
        return redirect()->route("doctor.edit", $doctor->id)->with('flash', ['type', 'danger', 'message' => 'OneTime Schedule has been deleted']);
    }

    // Unavailability
    public function unAvailabiltiyCreate(Request $request, User $doctor)
    {
        if (!$doctor) {
            abort(404);
        }

        // if admin
        if (Auth::user()->is_admin()) {
            return view("admin.doctor.schedule.unavailability", [
                "doctor" => $doctor,
            ]);
        }
        // If hospital
        if (Auth::user()->is_hospital()) {
            $hospital = Auth::user()->load(['doctors' => function ($query) use ($doctor) {
                return $query->where('id', $doctor->id);
            }]);
            if ($hospital->doctors->isEmpty()) {
                abort(404);
            }
            $doctor = $hospital->doctors->first();

            return view("hospital.doctor.schedule.unavailability", [
                "hospital" => $hospital,
                "doctor" => $doctor,
            ]);
        }
    }
    public function unAvailabiltiySave(Request $request, User $doctor)
    {
        $request->validate([
            "date" => ["required", "date"],
        ]);
        $date = Date("Y-m-d", strtotime($request->date));
        $request->merge([
            "date" => $date,
        ]);
        // if admin
        if (Auth::user()->is_admin()) {
            $doctor = $doctor;
        }
        // If hospital
        if (Auth::user()->is_hospital()) {
            $hospital = Auth::user()->load(['doctors' => function ($query) use ($doctor) {
                return $query->where('id', $doctor->id);
            }]);
            if ($hospital->doctors->isEmpty()) {
                abort(404);
            }
            $doctor = $hospital->doctors->first();
        }
        $doctor->load("unavailailities");

        $doctor->unavailailities()->updateOrCreate(
            ['date' => $date, 'doctor_id' => $doctor->id],
            $request->except("_token")
        );
        return redirect()->route("doctor.edit", $doctor->id)->with('flash', ['type', 'success', 'message' => 'Unavailability has been created']);
    }
    public function unAvailabiltiyEdit(Request $request, User $doctor, $date)
    {
        if (!$doctor) {
            abort(404);
        }
        $date = date("Y-m-d", strtotime($request->date));
        $doctor->load(["unavailailities" => function ($query) use ($date) {
            return $query->where("date", $date);
        }]);

        // if admin
        if (Auth::user()->is_admin()) {
            return view("admin.doctor.schedule.unavailability_edit", [
                "doctor" => $doctor,
                "date" => $date
            ]);
        }
        // If hospital
        if (Auth::user()->is_hospital()) {
            $hospital = Auth::user()->load(['doctors' => function ($query) use ($doctor) {
                return $query->where('id', $doctor->id);
            }]);
            if ($hospital->doctors->isEmpty()) {
                abort(404);
            }

            return view("hospital.doctor.schedule.unavailability_edit", [
                "hospital" => $hospital,
                "doctor" => $doctor,
                "date" => $date
            ]);
        }
    }
    public function unAvailabiltiyUpdate(Request $request, User $doctor, $date)
    {
        $request->validate([
            "date" => ["required", "date"],
        ]);
        $newdate = Date("Y-m-d", strtotime($request->date));
        $request->merge([
            "date" => $newdate,
        ]);

        // if admin
        if (Auth::user()->is_admin()) {
            $doctor = $doctor;
        }
        // If hospital
        if (Auth::user()->is_hospital()) {
            $hospital = Auth::user()->load(['doctors' => function ($query) use ($doctor) {
                return $query->where('id', $doctor->id);
            }]);
            if ($hospital->doctors->isEmpty()) {
                abort(404);
            }
            $doctor = $hospital->doctors->first();
        }
        $doctor->unavailailities()
            ->where(['date' => $date, 'doctor_id' => $doctor->id])
            ->update($request->except("_token"));
        return redirect()->route("doctor.edit", $doctor->id)->with('flash', ['type', 'success', 'message' => 'Unavailability has been updated']);
    }

    public function unAvailabiltiyDestroy(Request $request, User $doctor, $date)
    {
        // if admin
        if (Auth::user()->is_admin()) {
            $doctor = $doctor;
        }
        // If hospital
        if (Auth::user()->is_hospital()) {
            $hospital = Auth::user()->load(['doctors' => function ($query) use ($doctor) {
                return $query->where('id', $doctor->id);
            }]);
            if ($hospital->doctors->isEmpty()) {
                abort(404);
            }
            $doctor = $hospital->doctors->first();
        }
        $unavailability = $doctor->unavailailities()
            ->where(['date' => date("Y-m-d", strtotime($date)), 'doctor_id' => $doctor->id])
            ->delete();
        return redirect()->route("doctor.edit", $doctor->id)->with('flash', ['type', 'danger', 'message' => 'Unavailability has been deleted']);
    }
}
