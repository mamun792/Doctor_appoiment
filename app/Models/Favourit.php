<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourit extends Model
{
    use HasFactory;

    function relationDoctor(){
    return $this->hasOne(Doctor::class,'id','doctor_id');
    }

}

