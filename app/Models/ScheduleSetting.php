<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleSetting extends Model
{
    use HasFactory;
    protected $fillable = ['hospital_id', 'time_interval'];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
}
