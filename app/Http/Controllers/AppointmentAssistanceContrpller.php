<?php

namespace App\Http\Controllers;

use App\Models\_specilest;
use App\Models\Invoice_Deatiels;
use App\Models\Review;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AppointmentAssistanceContrpller extends Controller
{
    public function index()
    {


        return view('Backhands.Medical_assistance.index');
    }


    public function patient_list()
    {
        // Get the logged-in user
        $user = User::find(auth()->user()->id);

        // Check if the user is a doctor
        $doctor = Doctor::where('vendor_id', $user->login_id)->first();

        if ($doctor) {
            // User is a doctor
            $doctorId = $doctor->id;

            // Get the patient list for the doctor
            $p_id = Invoice_Deatiels::where('doctor_id', $doctorId)->get();

            $con = count($p_id);

            return view('Backhands.Medical_assistance.patient.index', compact('p_id', 'con'));
        } else {
            // User is not a doctor
            $con = 0;

            return view('Backhands.Medical_assistance.Appoinment.index', compact('con'));
        }
    }


    public function doctor_list()
    {

        $user = User::find(auth()->user()->id);
        $doctors = DB::table('users')->join('doctors', 'users.id', '=', 'doctors.vendor_id')->where('vendor_id',  $user->login_id)->get();

        return view('Backhands.Medical_assistance.Doctors.index', compact('doctors'));
    }

    public function Appointment_list()
    {
        $user = User::find(auth()->user()->id);

        $rr = DB::table('users')->join('doctors', 'users.login_id', '=', 'doctors.vendor_id')->where('vendor_id',  $user->login_id)->get();

        $con = $rr->count();
        if ($con == '0') {

            return view('Backhands.Medical_assistance.Appoinment.index', compact('con'));
        } else {
            $invice = Invoice_Deatiels::where('doctor_id', $rr[0]->id)->get();
            return view('Backhands.Medical_assistance.Appoinment.index', compact('invice', 'con'));
        }
    }


public function Review()
{
    $user = User::find(auth()->user()->id);

    $doctors = DB::table('users')
        ->join('doctors', 'users.login_id', '=', 'doctors.vendor_id')
        ->where('vendor_id', $user->login_id)
        ->get();

          $con = $doctors->count();

    if ( $con == 0) {
        return view('Backhands.Medical_assistance.Appoinment.index', compact('con'));
    } else {
    $invice = Review::whereIn('doctor_id', $doctors->pluck('id'))
            ->get();

        return view('Backhands.Medical_assistance.Reviews.index', compact('invice', 'con'));
    }
}
}
