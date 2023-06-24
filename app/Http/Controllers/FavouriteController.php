<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favourit;
use App\Models\Review;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
public function favourit(){
//return with('relationDoctor');
    $fav= Favourit::where('user_id',auth()->user()->id)->with('relationDoctor')->latest()->get();
    $review = Review::all();
    return view('Fonend.patient.favorites',compact('fav','review'));
}
}
