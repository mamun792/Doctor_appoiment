<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = ['doctor_themble_photo','fname','lname','phone_number','date_of_birth','about','hospital_address','city','locations','degree','dwards','year'];

    function relationwithspeclist()
    {
        return $this->hasOne(_specilest::class, 'id', 'special_id');
    }

    function relationwithUser()
    {
        return $this->hasOne(User::class,'id','doctor_id');
    }
    public function relationDoctor()
    {
        return $this->hasMany(time_schedules::class,'doctor_table_id','id');
    }
    public function relationDoctorDetiles()
    {
        return $this->hasOne(User::class,'id','vendor_id');
    }


    public function relationwithReviewDoctor()
    {
       // return $this->hasOne(Doctor::class, 'id', 'doctor_id');
       return $this->hasMany(Review::class,'doctor_id','id');
    }

    public function relationwithPatient()
    {
       // return $this->hasOne(Doctor::class, 'id', 'doctor_id');
       return $this->hasOne(Invoice_Deatiels::class,'doctor_id','id');
    }



}
