<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeDuration extends Model
{
    use HasFactory;
    public function relationwithTime()
    {
       // return $this->hasOne(Doctor::class, 'id', 'doctor_id');
       return $this->hasOne(User::class,'id','doctor_id');
    }

}
