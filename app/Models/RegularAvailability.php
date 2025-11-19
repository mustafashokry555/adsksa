<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegularAvailability extends Model
{
    use HasFactory;
    protected $table = "regular_availabilities";
    protected $primaryKey = "id";

    protected $fillable = ["time_interval", "week_day", "slots", "hospital_id", "doctor_id", "offer_id"];

    protected $casts = [
        'slots' => 'array',
    ];
    public function doctor(){
        return $this->belongsTo(User::class, "doctor_id", "id")->where("user_type", "D");
    }

    public function offer(){
        return $this->belongsTo(Offer::class, "offer_id", "id");
    }
}
