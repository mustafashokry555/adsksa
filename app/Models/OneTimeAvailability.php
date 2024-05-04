<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OneTimeAvailability extends Model
{
    use HasFactory;
    protected $table = "one_time_availabilities";
    protected $primaryKey = "id";
    protected $fillable = ["date", "time_interval", "slots", "hospital_id", "doctor_id"];
    protected $casts = [
        'slots' => 'array',
    ];
}
