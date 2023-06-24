<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo',
        'phone_number',
        'p_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function relationwithTime()
    {

       return $this->hasOne(TimeDuration::class,'doctor_id','id');
    }

    function relationInvoice()
    {
        return $this->hasOne(Invoice::class, 'patient_id','id');
    }

    function relationWithMedicalRecord()
    {
        return $this->hasOne(MedicalRecordAdd::class,'p_id','id');
    }

    function relationWithProfiledetial()
    {
        return $this->hasOne(Profile_detiel::class,'user_id','id');
    }

    function relationwithDoctor()
    {
        return $this->hasOne(Doctor::class,'doctor_id','id');
    }


    protected $primaryKey = 'id';

    // Define the relationship with the same table
    public function login_relatishoip()
    {
        return $this->hasOne(User::class, 'login_id', 'id');
    }

}
