<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendOtpEmail extends Notification implements ShouldQueue
{
    use Queueable;
    protected $otp;
    protected $key_word;
    protected $subject;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($otp, $subject = null, $key_word = null)
    {
        $this->otp = $otp;
        $this->subject = $subject;
        $this->key_word = $key_word;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject($this->subject)
            ->line('You are receiving this email because we received '.$this->key_word.' request for your account.')
            ->line('Your OTP is: ' . $this->otp)
            ->line('This OTP will expire in 5 minutes.')
            ->line('If you did not request a '.$this->key_word.', no further action is required.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
