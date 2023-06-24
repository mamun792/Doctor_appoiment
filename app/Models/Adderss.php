<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adderss extends Model
{
    use HasFactory;
    protected $fillable=['fname','lname','email','phone_number'];
}
