<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\User;
use App\Models\Profile_detiel;
use App\Models\Invoice_Deatiels;
use App\Models\MedicalDetieles;
use App\Models\MedicalRecordAdd;
use App\Models\Prescription;
use App\Models\Review;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
// use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Models\patient_test;
use Illuminate\Support\Facades\File;
use Faker\Provider\Medical;
use Barryvdh\DomPDF\Facade\Pdf;

class PatientController extends Controller
{
    public function patient_dashboard()
    {

        $appoipent = Invoice_Deatiels::where('patient_id', auth()->user()->id)->get();
        $medical_detailes = MedicalDetieles::latest()->get();
        $recoed_count =  $medical_detailes->count();
        $appoiment_count =   $appoipent->count();

        $prescprition = patient_test::where('p_id', auth()->user()->id)->get();
        // return $prescprition[0]->relationwithPrescption;
        return view('Fonend.patient.index', compact('medical_detailes', 'appoipent', 'appoiment_count', 'recoed_count', 'prescprition'));
    }
    public function store(Request $request)
    {

        $vali = $request->validate(
            [
                'fname' => 'required',
                'lname' => 'required',
                'date_of_birth' => 'required',
                'bgroup' => 'required',
                'email' => 'required',
                'phone_number' => 'required',
                'city' => 'required',
                'division' => 'required',
                'country' => 'required',
                'adderss' => 'required',
                'about' => 'required',

            ],
        );



        $patient_id = Profile_detiel::insertGetId([
            'user_id' => auth()->id(),
            'fname' => $request->fname,
            'lname' => $request->lname,
            'date_of_birth' => $request->date_of_birth,
            'bgroup' => $request->bgroup,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'city' => $request->city,
            'division' => $request->division,
            'zip' => $request->zip,
            'country' => $request->country,
            'adderss' => $request->adderss,
            'about' => $request->about,
            'created_at' => Carbon::now(),

        ]);
        return  back()->with('succ', "Succeefully information Added!");
    }
    public function edit($id)
    {

        $update = Profile_detiel::find($id);
        return view('Fonend.patient.patient_detiles_edit', compact('update'));
    }

    public function update(Request $request,  $patient_detiel_id)
    {
        $request->validate(
            [
                'fname' => 'required',
                'lname' => 'required',
                'date_of_birth' => 'required',

                'email' => 'required',
                'phone_number' => 'required',
                'city' => 'required',

                'country' => 'required',
                'adderss' => 'required',
                'about' => 'required',

            ],
        );
        Profile_detiel::find($patient_detiel_id)->update([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'date_of_birth' => $request->date_of_birth,

            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'city' => $request->city,

            'zip' => $request->zip,
            'country' => $request->country,
            'adderss' => $request->adderss,
            'about' => $request->about,
            'updated_at' => Carbon::now(),
        ]);
        return back()->with('succ', 'Paitent Profile Succeefully Updated!');
    }
    public function profile_change_password()
    {

        return view('Fonend.patient.change_password');
    }

    public function patient_invoice()
    {

        $doctor_id = Invoice_Deatiels::where('patient_id', auth()->id())->get();
        return view('Fonend.patient.patient_invoices', compact('doctor_id'));
    }
    public function  patient_review($id)
    {
        $inoice_detail = Invoice_Deatiels::where('id', $id)->get();
        $doctor_revie_id = $id;
        return view('Fonend.patient.patient_reviews', compact('doctor_revie_id', 'inoice_detail'));
    }

    public function  profile_review_add(Request $request)
    {

        $request->validate([
            'rating' => 'required',
            'title' => 'required|max:35',
            'comment' => 'required|max:100'
        ]);


        $doctor_id = Invoice_Deatiels::find($request->comment_id)->doctor_id;

        Review::insert([
            'invioce_detealies_id' => $request->comment_id,
            'user_id' => auth()->user()->id,
            'doctor_id' => $doctor_id,
            'rating' => $request->rating,
            'title' => $request->title,
            'comment' => $request->comment,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }

    public function patient_medical_record($id)
    {
        $medical_record = MedicalRecordAdd::where('p_id', $id)->latest()->get();
        return view('Fonend.patient.patient_medical_record', compact('medical_record'));
    }

    public function patient_medical_record_delete($id)
    {
        MedicalRecordAdd::destroy($id);
        return back()->with('del', 'succeefully delete!');
    }

    public function patient_medical_record_add(Request $request)
    {


        $request->validate([
            'title' => 'required',
            'patient_relative' => 'required',
            'hospital' => 'required',
            'hospital' => 'required',


            'user_prespation' => 'required|mimes:pdf,xlx,csv,jpeg,png,png|max:5120',
            'services' => 'required',
            'tratment_date' => 'required',
        ]);




        if ($request->hasfile('user_prespation')) {
            $exteion_name = Str::random(20) . "." . $request->file('user_prespation')->getClientOriginalExtension();

            $request->user_prespation->move(public_path('uploads/medical_report/'),  $exteion_name);




            MedicalRecordAdd::insert([
                'p_id' => auth()->user()->id,
                'title' => $request->title,
                'patient_relative' => $request->patient_relative,
                'hospital' => $request->hospital,

                'services' => $request->services,
                'tratment_date' => $request->tratment_date,
                'user_prespation' => $exteion_name,
                'created_at' => Carbon::now(),
            ]);
        }
        return back()->with('Success', 'succeefully added!');
    }

    public function  patient_medical_deatiles($id)
    {

        $medical_detailes = MedicalDetieles::where('p_id', $id)->latest()->get();
        return view('Fonend.patient.patient_medical_deatiles', compact('medical_detailes'));
    }

    public function  patient_medical_deatiles_add(Request $request)
    {
        $request->validate([
            'bmi' => 'required',
            'heart' => 'required',
            'Weight' => 'required',
            'Fbc' => 'required',

        ]);

        MedicalDetieles::insert([
            'p_id' => auth()->user()->id,
            'bmi' => $request->bmi,
            'heart' => $request->heart,
            'Weight' => $request->Weight,

            'Fbc' => $request->Fbc,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('Success', 'succeefully added!');
    }

    public function patient_medical_deatiles_delete($id)
    {
        MedicalDetieles::destroy($id);
        return back()->with('del', 'succeefully delete!');
    }

    public function patient_medical_record_edit($id)
    {
        $medical = MedicalDetieles::find($id);
        return view('Fonend.patient.medical_record_edit', compact('medical'));
    }
    public function patient_medical_record_edit_add(Request $request)
    {

        MedicalDetieles::find($request->user_id)->update([
            'bmi' => $request->bmi,
            'heart' => $request->heart,
            'Weight' => $request->heart,
            'Fbc' => $request->Fbc,
        ]);
        return back()->with('del', 'Succeefully delete!');
    }

    public function  patient_medical_record_download($id)
    {
        $document = MedicalRecordAdd::find($id);

        $file = public_path("uploads/medical_report/{$document->user_prespation}");



        return \Response::download($file);
    }

    public function  patient_prescription($id)
    {

        $prescprition = patient_test::where('id', $id)->get();



        return view('Fonend.patient.patient_prescption', compact('prescprition'));
    }

    public function  patient_prescription_download($id)
    {

        $prescprition = patient_test::where('id', $id)->get();


        $p_id = User::where('id', auth()->user()->id)->get();


        $patient = Profile_detiel::where('user_id', auth()->user()->id)->get();
        $patient_cont = $patient->count();
        // Generate the PDF using the view file and data
        $pdf = PDF::loadView('Fonend.patient.patient_prescpition_download', compact('prescprition', 'p_id', 'patient', 'patient_cont'));


        // Download the PDF file
        return $pdf->download('patient_prescription.pdf');
    }

    public function patient_invoices($id)
    {
        $invoice = Invoice_Deatiels::find($id);
        return view('Fonend.patient.payment_detiles', compact('invoice'));
    }
}
