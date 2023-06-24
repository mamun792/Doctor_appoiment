<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class patient_test extends Model
{
    use HasFactory;
    protected $fillable = ['p_id', 'Symptoms', 'tests', 'Advice'];

    public function relationwithPrescption()
    {
        return $this->hasMany(Prescription::class, 'test_id','id');

    }

    function relationwithPatientTest()
    {
        return $this->hasOne(User::class,'id','d_id');
    }



}
