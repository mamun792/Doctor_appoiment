<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class _specilest extends Model
{
    use HasFactory;
    protected $fillable=['category_photo','special'];

    public function relationDoctorWithSpecical()
    {
        return $this->hasMany(Doctor_detiel::class,'id','specialid');
    }
}
