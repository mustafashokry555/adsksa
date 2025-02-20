<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'from_id', 
        'to_id', 
        'message_en', 
        'isRead', 
        'title_en', 
        'title_ar', 
        'message_ar', 
        'notifiable_type', 
        'notifiable_id'
    ];

    public function geTtitleAttribute($value)
    {
        if (app()->getLocale() == 'ar') {
            return $this->title_ar;
        } else {
            return $this->title_en;
        }
    }

    public function getMessageAttribute($value)
    {
        if (app()->getLocale() == 'ar') {
            return $this->message_ar;
        } else {
            return $this->message_en;
        }
    }

    public function sender(){
        return $this->belongsTo(User::class,'from_id');
    }

    public function reciever(){
        return $this->belongsTo(User::class,'to_id');
    }

    public function notifiable()
    {
        return $this->morphTo();
    }
}
