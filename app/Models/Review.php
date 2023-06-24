<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public function relationwithReview()
    {
        return $this->hasOne(User::class, 'id', 'user_id');

    }

    public function relationwithReviews()
    {
        return $this->hasMany(User::class, 'id', 'user_id');

    }

    public function relationwithReviewss()
    {
        return $this->hasOne(User::class, 'id', 'user_id');

    }
    public function relationwithReviewDoctor()
    {
        return $this->hasOne(Doctor::class, 'id', 'doctor_id');

    }

    function relationWithReplay()
    {
        return $this->hasOne(Replay::class, 'doctor_id','id');
    }


}
