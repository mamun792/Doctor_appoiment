<?php

namespace App\Http\Controllers;

use App\Models\Doctor_detiel;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use LVR\CountryCode\Three;
class DoctorDetielController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = User::find(Auth::id());

       $profile_det = Doctor::where('doctor_id', $user->id)->get();

        return view('Fonend.DoctoDash.Doctor_dash.index', compact('profile_det'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('Fonend.Doctor_dash.inser_data');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return"kk";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor_detiel  $doctor_detiel
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor_detiel $doctor_detiel)
    {
        //return  $doctor_detiel;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor_detiel  $doctor_detiel
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor_detiel $doctor_detiel, $id)
    {
        $update = Doctor::find($id);
        return view('Fonend.DoctoDash.Doctor_dash.update', compact('update'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor_detiel  $doctor_detiel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $doctor_detiel_id)
    {
        $request->validate(
            [

                'fname' => 'required|max:25',
                'lname' => 'required',
                 'phone_number' => 'required',
                // 'phone_number' => 'required|numeric|digits:10',
                'city' => 'required',
                'degree' => 'required',
                'hospital_address' => 'required',
                'locations' => 'required',
                'degree'=> 'required',
                'about' => 'required',
                'year' => 'required',
                'year_of_completion' => 'required',
                'dwards' => 'required',
            ],

        );

        Doctor::find($doctor_detiel_id)->update([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'phone_number' => $request->phone_number,
            'date_of_birth' => $request->date_of_birth,
            'about' => $request->about,
            'hospital_address' => $request->hospital_address,
            'city' => $request->city,
            'locations' => $request->locations,
            'degree' => $request->degree,
            'dwards' => $request->dwards,
            'year' => $request->year,
            'updated_at' => Carbon::now(),
        ]);
        return back()->with('succ', 'Doctor Profile Succeefully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor_detiel  $doctor_detiel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor_detiel $doctor_detiel)
    {
        //
    }
}
