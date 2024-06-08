<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientDetail extends Model
{
    use HasFactory;
    protected $table = 'patient_details';
    protected $fillable = ['height', 'weight','disease', 'user_id'];
    protected $casts = [
        'disease' => 'array',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
