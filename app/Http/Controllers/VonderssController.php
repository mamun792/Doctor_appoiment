<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Invoice;
use App\Models\Invoice_Deatiels;
use App\Models\MedicalDetieles;
use App\Models\MedicalRecordAdd;
use App\Models\Profile_detiel;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;

class VonderssController extends Controller
{
    public function vondor_dashboard()
    {

        $users = User::all();

        $doctor = Doctor::where('vendor_id', auth()->user()->id)->get();
        $patient_list = Profile_detiel::latest()->get();
       $invices = Invoice_Deatiels::all();



        $earliestMonth = $doctor->min('created_at')->startOfMonth();
        $latestMonth = $doctor->max('created_at')->startOfMonth();


        $months = [];
        $currentMonth = clone $earliestMonth;
        while ($currentMonth <= $latestMonth) {
            $months[] = $currentMonth->format('M Y');
            $currentMonth->add(new \DateInterval('P1M'));
        }


        $salesData = $doctor->groupBy(function ($doctors) {
            return date('M Y', strtotime($doctors->created_at));
        })->map(function ($group) {
            return $group->sum('price');
        })->values()->toArray();


        $salesData = array_pad($salesData, count($months), 0);


       $patients = User::all();

        // Group doctors by month and count the number of doctors per month
        $doctorData = $doctor->groupBy(function ($doctors) {
            return $doctors->created_at->format('M Y');
        })->map(function ($group) {
            return $group->count();
        })->values()->toArray();

        // Group patients by month and count the number of patients per month
        $patientData = $patients->groupBy(function ($patient) {
            return $patient->created_at->format('M Y');
        })->map(function ($group) {
            return $group->count();
        })->values()->toArray();

        // Get the unique months as labels for the chart
        $months = $doctor->pluck('created_at')->unique()->map(function ($date) {
            return $date->format('M Y');
        })->toArray();

        return view('Backhands.Vendor_dashboard.index', compact('users', 'doctor', 'patient_list', 'invices', 'salesData', 'months', 'patients', 'doctorData', 'patientData', 'months'));
    }



    public function patient_list()
    {

        $user = Invoice_Deatiels::latest()->get();

        return view('Backhands.Vendor_dashboard.patient.index', compact('user'));
    }

    public function doctor_list()
    {

        $user = Doctor::latest()->get();

        return view('Backhands.Vendor_dashboard.doctor.index', compact('user'));
    }
    public function  patient_appointment_list()
    {
        $user = Invoice_Deatiels::latest()->get();
        return view('Backhands.Vendor_dashboard.tranjation.index', compact('user'));
    }
    public function  patient_appointment_list_delete($t_id)
    {
        Invoice_Deatiels::destroy($t_id);
        return back()->with('dele', 'Succeefully delete');
    }

    public function  patient_reviews_list()
    {

        $invoice = Invoice_Deatiels::all();
        return view('Backhands.Vendor_dashboard.review.index', compact('invoice'));
    }

    public function  patient_tranjection_list()
    {

        $invoice_detiles = Invoice_Deatiels::latest()->get();
        return view("Backhands.Vendor_dashboard.appoiment.index", compact('invoice_detiles'));
    }

    public function patient_medical_report($id)
    {

        $p_id = $id;
        return view('Backhands.Vendor_dashboard.patient.medical_record_add', compact('p_id'));
    }
    public function patient_medical_report_add(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'patient_relative' => 'required',
            'hospital' => 'required',
            'hospital' => 'required',

            'user_prespation' => 'required|file|mimes:jpeg,png,pdf|max:5120',
            'services' => 'required',
            'tratment_date' => 'required',
        ]);

        if ($request->hasfile('user_prespation')) {
            $exteion_name = Str::random(20) . "." . $request->file('user_prespation')->getClientOriginalExtension();
            $path = 'uploads/medical_report' . $exteion_name;
            Image::make($request->file('user_prespation'))->save($path);




            MedicalRecordAdd::insert([
                'p_id' => $request->patient_id,
                'title' => $request->title,
                'patient_relative' => $request->patient_relative,
                'hospital' => $request->hospital,

                'services' => $request->services,
                'tratment_date' => $request->tratment_date,
                'user_prespation' => $exteion_name,
                'created_at' => Carbon::now(),
            ]);
        }
        return "ff";
        return back()->with('Success', 'succeefully added!');
    }

    public function doctor_delete($id)
    {
        $doctor = Doctor::find($id);

        if ($doctor) {
            $doctor->delete();
            session()->flash('success', 'Doctor deleted successfully.');
        }

        return redirect()->back();
    }
}
