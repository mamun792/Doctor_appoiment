<?php

namespace App\Http\Controllers;

use App\Models\Adderss;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Invoice_Deatiels;
use App\Models\Profile_detiel;
use Carbon\carbon;
use Symfony\Component\HttpKernel\Profiler\Profile;

class CheckoutController extends Controller
{
    public function check_out(Request $request)
    {


        $date = $request->Date;
        $datapase = $request->time;
        $doctor_id = Doctor::find($request->id)->id;
        $doctor = Doctor::find($request->id);
        $patient_id = auth()->id();

        $appointmentDateTime = $request->appointment_date . ' ' . $request->appointment_time;

        $existingAppointment = Invoice_Deatiels::where('doctor_id',   $doctor_id)
            ->where('appioment_date', $date)
            ->where('appioment_time',  $datapase)
            ->exists();

        if ($existingAppointment) {

            return redirect()->route('doctor.book.now', ['id' =>  $doctor_id])->with('error', 'The selected appointment time is not available.');
        }


        // Check for appointments in the next 7 days
        $nextSevenDays = Carbon::now()->addDays(7)->toDateString();
        $appointmentsNextSevenDays = Invoice_Deatiels::where('doctor_id',   $doctor_id)
            ->whereDate('appioment_date', '>=', Carbon::now()->toDateString())
            ->whereDate('appioment_date', '<=', $nextSevenDays)
            ->pluck('appioment_time')
            ->toArray();

        // Pass the available time slots for the next 7 days to the view
        $availableTimeSlots = [];
        $startTime = '09:00';
        $endTime = '17:00';
        $interval = 30;

        $currentTime = $startTime;
        while (strtotime($currentTime) <= strtotime($endTime)) {
            $time = date('H:i', strtotime($currentTime));
            if (!in_array($time, $appointmentsNextSevenDays)) {
                $availableTimeSlots[] = $time;
            }
            $currentTime = date('H:i', strtotime($currentTime) + ($interval * 60));
        }



        $profile_adde = Adderss::where('login_id', $patient_id)->get()->count();
        if ($profile_adde == 0) {

            return view('Fonend.checkout', compact('profile_adde', 'datapase', 'doctor', 'date'));
        } else {

            $address = Adderss::where('login_id', auth()->id())->get();
            //   return  $profile_adderss = Profile_detiel::where('user_id', $patient_id)->get();
            return view('Fonend.checkout', compact('datapase', 'doctor', 'date', 'address', 'profile_adde'));
        }
    }
}
