<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\NotificationResource;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $notifications = Notification::where(function($query) use ($user) {
            $query->where('to_id', $user->id)
                ->orWhereNull('to_id');
        })
        ->latest()
        ->get();
        $unreadCount = Notification::where(function($query) use ($user) {
            $query->where('to_id', $user->id)
                ->orWhereNull('to_id');
        })
        ->where('isRead', 0)
        ->count();

        $notifications = NotificationResource::collection($notifications);
        return $this->SuccessResponse(200, "", [
            'notifications' => $notifications,
            'unread_count' => $unreadCount
        ]);

    }

    // public function show( $id)
    // {
    //     return new NotificationResource($id);
    // }

    public function markAsRead($id)
    {
        $notification = Notification::find($id);
        if (!$notification) {
            return $this->ErrorResponse(404, "Notification not found");
        }
        $notification->isRead = 1;
        $notification->save();
        return $this->SuccessResponse(200, "", "Notification marked as read");
    }
}
