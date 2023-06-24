<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    protected $fillable = ['medicine_name', 'medicine_time', 'meal', 'days', 'doctor_id', 'p_id', 'Symptoms', 'tests', 'Advice'];



}
