<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Mahababur Rahaman',
            'email' =>'mahababurrahaman2014@gmail.com',
            'password' => Hash::make('12345678'),
            'phone_number'=>'01745010925',
            'created_at' =>Carbon::now(),
            'role'=>'admin',
           // 'profile_photo'=>'images.jpeg',
        ]);
    }
}
