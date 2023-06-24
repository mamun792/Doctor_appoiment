<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalDetieles extends Model
{
    use HasFactory;
  protected $fillable=['bmi','heart','Weigh','Fbc'];

    function relationWithPatientMedicalDetailes()
    {
        return $this->hasOne(User::class, 'id','p_id');
    }
}
