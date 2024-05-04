<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = ['from_id','appointment_id', 'to_id', 'message','isRead'];

    public function sender(){
        return $this->belongsTo(User::class,'from_id');
    }

    public function reciever(){
        return $this->belongsTo(User::class,'to_id');
    }

    public function appointment(){
        return $this->belongsTo(Appointment::class);
    }
}
