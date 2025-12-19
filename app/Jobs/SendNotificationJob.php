<?php

namespace App\Jobs;

use App\Http\Services\FirebaseService;
use App\Models\Notification;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    public $tries = 3;
    public $timeout = 120;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        $usersQuery = User::active()
            ->where('user_type', 'U');

        // Handle ALL or SELECTED users
        if (!in_array('all', $this->data['users_ids'])) {
            $usersQuery->whereIn('id', $this->data['users_ids']);
        }

        $firebase = new FirebaseService();

        $usersQuery->chunk(500, function ($users) use ($firebase) {

            foreach ($users as $user) {

                // 1️⃣ Save notification in DB
                $notification = Notification::create([
                    'from_id' => $this->data['from_id'],
                    'to_id' => $user->id,
                    'title_ar' => $this->data['title_ar'],
                    'title_en' => $this->data['title_en'],
                    'message_ar' => $this->data['message_ar'],
                    'message_en' => $this->data['message_en'],
                    'isRead' => 0,
                    'notifiable_type' => $this->data['offer_id']
                        ? Offer::class
                        : null,
                    'notifiable_id' => $this->data['offer_id'],
                ]);

                // 2️⃣ Send Firebase push (only if token exists)
                if ($user->device_token) {
                    $firebase->notify(
                        app()->getLocale() === 'ar'
                            ? $notification->title_ar
                            : $notification->title_en,

                        app()->getLocale() === 'ar'
                            ? $notification->message_ar
                            : $notification->message_en,

                        $user->device_token,
                        [
                            'notification_id' => (string) $notification->id,
                            'offer_id' => (string) $this->data['offer_id'],
                        ]
                    );
                }
            }
        });
    }
}
