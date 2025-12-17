<?php

namespace App\Http\Controllers;

use App\Http\Services\FirebaseService;
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
        $users = User::active()->where('user_type', 'U');
        $user = null;
        if (in_array('all', $request->users_ids)) {
            $users = $users->get();
        } else {
            $user = $users->whereIn('id', $request->users_ids)->first();
        }
        // foreach ($users as $user) {
        $notification = new Notification();
        $notification->from_id = Auth::user()->id;
        $notification->to_id = $user->id;
        $notification->title_ar = $request->title_ar;
        $notification->title_en = $request->title_en;
        $notification->message_ar = $request->message_ar;
        $notification->message_en = $request->message_en;
        if ($request->offer_id) {
            $notification->notifiable_type = Offer::class;
            $notification->notifiable_id = $request->offer_id;
        }
        $notification->isRead = 0;
        $notification->save();
        if ($user && $user->device_token) {
            $firebase = new FirebaseService();
            $firebase->notify($notification->title_ar, $notification->message_ar, $user->device_token);
        }
        // }
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
