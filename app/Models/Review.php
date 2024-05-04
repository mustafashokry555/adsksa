<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'doctor_id', 'star_rated', 'review_title', 'review_body', 'hospital_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
}
