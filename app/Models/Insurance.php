<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;
    protected $fillable = ['name','email', 'user_id', 'address','phone1','city','phone2','state','fax'];

    public function hospitals()
    {
        return $this->belongsToMany(Hospital::class);
    }
}
