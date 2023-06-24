<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Replay extends Model
{
    use HasFactory;

    function relationwithReplay()
    {
        return $this->hasOne(Review::class,'doctor_id','id');
    }
}
