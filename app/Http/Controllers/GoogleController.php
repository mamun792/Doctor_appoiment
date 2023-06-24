<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountCreation;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callback()
    {
       $user = Socialite::driver('google')->user();
        $generate_password = Str::random(8);

        User::insert([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'phone_number' => '017',
            'password' => bcrypt($generate_password),
            'created_at' => Carbon::now(),
            'role' => 'patient'
        ]);
        if (Auth::attempt([

            'email' => $user->getEmail(),
            'password' => $generate_password,
        ])) {
            $info = [
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => $generate_password,
                'role' => 'patient',
            ];
            Mail::to($user->getEmail())->send(new AccountCreation($info));
            return redirect('doctor/dashboard');
        }
    }
}
