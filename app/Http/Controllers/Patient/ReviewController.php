<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'user_id' => 'required',
            'doctor_id' => 'required',
            'hospital_id' => 'required',
            'star_rated' => 'required',
            'review_title' => 'required',
            'review_body' => 'required|max:100',
        ]);

        $patient = User::query()
            ->join('appointments', 'users.id', '=', 'appointments.patient_id')
            ->where('appointments.patient_id', Auth::id())
            ->select('users.*')->first();
        $review = Review::query()->where('user_id', Auth::id())->where('doctor_id', $request->doctor_id)->first();

        if (!empty($patient)) {

            if (!empty($review)) {
                return redirect()->back()->with('flash', ['type', 'success', 'message' => 'You Already rated this profile']);
            } else {
                Review::create($attributes);
                return redirect()->back()->with('flash', ['type', 'success', 'message' => 'Thank You for rating my profile']);
            }
        } else {
            return redirect()->back()->with('error',  'You can\'t rate this profile because you didn\'t book any appointment');
        }
    }

    public function index()
    {
        if (Auth::user()->is_admin()) {
            $reviews = Review::query()->orderByDesc('id')->get();
            return view('admin.review.index', [
                'reviews' => $reviews,
            ]);
        } elseif (Auth::user()->is_hospital()) {
            $reviews = Review::query()->where('hospital_id', Auth::user()->hospital_id)->orderByDesc('id')->paginate(10);
            $review_sum = Review::where('hospital_id', Auth::user()->hospital_id)->sum('star_rated');
            if ($review_sum > 0) {
                $review_value = $review_sum / $reviews->count();
            } else {
                $review_value = 0;
            }
            return view('hospital.review.index', [
                'reviews' => $reviews,
                'review_value' => $review_value,
            ]);
        } elseif (Auth::user()->is_doctor()) {

            $reviews = Review::query()->where('doctor_id', Auth::id())->orderByDesc('id')->paginate(10);
            $review_sum = Review::where('doctor_id', Auth::id())->sum('star_rated');
            if ($reviews->count() > 0) {
                $review_value = $review_sum / $reviews->count();
            } else {
                $review_value = 0;
            }
            return view(
                'doctor.review.index',
                [
                    'reviews' => $reviews,
                    'review_value' => $review_value,
                ]
            );
        } else {
            abort(401);
        }
    }
}
