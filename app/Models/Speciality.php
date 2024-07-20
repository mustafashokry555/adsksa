<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'image'];

    public function users()
    {
        return $this->hasMany(User::class,'speciality_id');
    }

    public function getImageAttribute($value){
        if($value !=null) return env('BASE_URL').'/api/getImage/'.$value; 
    }

}
