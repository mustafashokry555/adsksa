<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'clinic_title', 'clinic_location', 'clinic_fee', 'clinic_start_time', 'clinic_end_time',];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
