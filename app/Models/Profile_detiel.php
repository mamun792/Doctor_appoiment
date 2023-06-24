<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Profile_detiel extends Model
{
    use HasFactory;
    protected $fillable =['fname','lname','date_of_birth','email','phone_number','city','zip','country','adderss','about'];

   public function relationwithprofile()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
      //  return $this->DB::table('users')->join('profile_detiels', 'id', '=', 'profile_detiels.user_id')->get();
    }


}
