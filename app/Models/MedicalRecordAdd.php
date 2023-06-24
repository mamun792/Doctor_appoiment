<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecordAdd extends Model
{
    use HasFactory;
    protected $fillable =['title','patient_relative','hospital','user_prespation','services','tratment_date'];

    function relationWithPatient()
    {
        return $this->hasOne(User::class, 'id','p_id');
    }
}
