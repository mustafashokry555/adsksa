<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unavailability extends Model
{
    use HasFactory;
    protected $table = "unavailabilities";
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ["date", 'offer_id', "hospital_id", "doctor_id"];
}
