<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class time_schedules extends Model
{
    use HasFactory;
    protected $fillable =['sart_time','end_time','day','saturday','sunday','monday','tuesday',
'wednesday','thursday','friday'];



}
