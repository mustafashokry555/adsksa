<?php

namespace App\Http\Controllers;

use App\Http\Services\FirebaseService;
use App\Jobs\SendNotificationJob;
use App\Models\Notification;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->is_doctor()) {
            $notifications = Notification::with('reciever')->where('to_id', Auth::user()->id)->where('isRead', 1)->get();
            foreach ($notifications as $notification) {
                $notification->update(['isRead' => 0]);
            }
            return view('doctor.notification', compact('notifications'));
        } elseif (Auth::user()->is_patient()) {
            $notifications = Notification::with('reciever')->where('to_id', Auth::user()->id)->where('isRead', 1)->get();
            foreach ($notifications as $notification) {
                $notification->update(['isRead' => 0]);
            }
            return view('patient.notification', compact('notifications'));
        } else {
            abort(401);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $offers = Offer::where('is_active', 1)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now());
        $users = User::active()->where('user_type', 'U');
        if (Auth::user()->is_admin()) {
            $offers = $offers->whereHas('hospital', function ($q) {
                $q->where('is_active', 1);
            })->get();
            $users = $users->get();
            return view('admin.notification.send', compact('users', 'offers'));
        } elseif (Auth::user()->is_hospital()) {
            $notifications = Notification::with('reciever')->where('to_id', Auth::user()->id)->where('isRead', 1)->get();
            foreach ($notifications as $notification) {
                $notification->update(['isRead' => 0]);
            }
            return view('patient.notification', compact('notifications'));
        } else {
            abort(401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title_ar' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
            'message_ar' => ['required', 'string'],
            'message_en' => ['required', 'string'],
            'users_ids' => ['required'],
            'offer_id' => ['nullable', 'exists:offers,id'],
        ]);

        SendNotificationJob::dispatch([
            'from_id' => auth()->id(),
            'users_ids' => $request->users_ids,
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'message_ar' => $request->message_ar,
            'message_en' => $request->message_en,
            'offer_id' => $request->offer_id,
        ]);

        return redirect()->back()
        ->with('flash', ['type' => 'success', 'message' => 'Notification queued successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
