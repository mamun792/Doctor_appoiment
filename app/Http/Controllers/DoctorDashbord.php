<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\time_schedules;
use App\Models\Doctor;
use App\Models\TimeDuration;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\Floats;
use App\Http\Controllers\double;

use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Writer;;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Invoice_Deatiels;
use App\Models\patient_test;
use App\Models\Prescription;
use App\Models\Profile_detiel;
use App\Models\Review;
use App\Models\Replay;
use App\Models\User;
use Spatie\Browsershot\Browsershot;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class DoctorDashbord extends Controller
{
    public function index()
    {


        $date = Carbon::today()->toDateString();;
        $today = Carbon::createFromFormat('Y-m-d', $date)->format('d M Y');
        $doctor = Doctor::where('doctor_id', Auth::id())->first();


        $totalPatients = Invoice_Deatiels::where('doctor_id', $doctor->id)->pluck('patient_id')->unique()->count();
        $todayPatients = Invoice_Deatiels::where('doctor_id', $doctor->id)->whereDate('created_at', Carbon::today())->distinct('patient_id')->count('patient_id');
         $todayAppointmentss = Invoice_Deatiels::where('doctor_id', $doctor->id)->whereDate('appioment_date',  $today)->count();
         $todayDate=date('Y-m-d');

        $count =  $doctor->count();

        if ($count == '0') {
            return view('Fonend.DoctoDash.index', compact('count', 'totalPatients', 'todayPatients', 'todayAppointments','todayAppointmentss','todayDate'));
        } else {

            $today = date('Y-m-d'); // Get the current date

            $todayAppointments = Invoice_Deatiels::where('doctor_id', $doctor->id)
                 ->whereDate('appioment_date', $today)
                 ->where('appioment_time', '>=', date('H:i')) // Add a condition to filter out past appointments
                 ->get();


            $patient = Invoice_Deatiels::where('doctor_id', $doctor->id)->get();

            return view('Fonend.DoctoDash.index', compact('patient', 'count', 'todayAppointments', 'totalPatients', 'todayPatients', 'todayAppointments','todayDate', 'todayAppointmentss'));
        }
    }
    public function doctor_change_password()
    {
        return view('Fonend.DoctoDash.Doctor_dash.doctor_change_password');
    }

    public function  doctor_time_schedule()
    {
        $doctor_table = Doctor::where('doctor_id', Auth::id())->get();

        $time = time_schedules::where('doctor_login_id', Auth::id())->latest()->get();
        return view('Fonend.DoctoDash.Doctor_dash.doctor_time_schedule', compact('time', 'doctor_table'));
    }




    public function doctor_patient_list()
    {



        $doct_log_id = Doctor::where('doctor_id', auth()->id())->get();

        $p_list_count = $doct_log_id->count();
        if ($p_list_count == '0') {

            return view('Fonend.DoctoDash.Doctor_dash.doctor_patients_lists', compact('p_list_count'));
        } else {
            foreach ($doct_log_id as $doctor_id) {

                $doctor_ids = Invoice_Deatiels::where('doctor_id', $doctor_id->id)->get();
                return view('Fonend.DoctoDash.Doctor_dash.doctor_patients_lists', compact('doctor_ids', 'p_list_count'));
            }
        }
    }

    public function doctor_patient_invoices()
    {

        $doct_log_id = Doctor::where('doctor_id', auth()->id())->get();

        $invoice_c = $doct_log_id->count();
        if ($invoice_c == '0') {

            return view('Fonend.DoctoDash.Doctor_dash.doctor_patients_invoices_list', compact('invoice_c'));
        } else {
            $doctor_id = Invoice_Deatiels::where('doctor_id', $doct_log_id[0]->id)->get();
            return view('Fonend.DoctoDash.Doctor_dash.doctor_patients_invoices_list', compact('doctor_id', 'invoice_c'));
        }
    }

    public function  Doctor_patient_invoices_download($p_id)
    {

        $patient_reg_det = User::where('id', $p_id)->get();

        $invoices_download = Invoice_Deatiels::where('id', $p_id)->get();

        $pdf = Pdf::loadView('Fonend.DoctoDash.Doctor_dash.invoice', compact('invoices_download', 'patient_reg_det'));
        return $pdf->download('invoice.pdf');
    }

    public function doctor_delete_schedules($id)
    {
        time_schedules::find($id)->delete();
        return back()->with('det', 'Succeefully Delete');
    }

    public function  doctor_time_schedule_edit($id)
    {
        $indi =  time_schedules::find($id);
        return view('Fonend.DoctoDash.Doctor_dash.doctor_shedul_edit', compact('indi'));
    }


    public function  patient_invoices($p_id)
    {
        $doctor_info = Doctor::where('doctor_id', auth()->id())->get();


        $invoice_id = Invoice_Deatiels::where('invoices_id', $p_id)->get();
        foreach ($invoice_id as  $invoice_ids) {
            $test = $invoice_ids->patient_id;
        }

        $patient_reg_det = User::where('id', $test)->get();

        $patient_detieal = Profile_detiel::where('user_id', $test)->get();
        $patient_con = $patient_detieal->count();
        return view('Fonend.DoctoDash.Doctor_dash.doctor_patients_invoices', compact('invoice_id', 'doctor_info', 'patient_detieal', 'patient_reg_det', 'patient_con'));
    }

    public function  doctor_time_schedule_changes(Request $request, $id)
    {

        $request->validate(
            [

                'sart_time' => 'required',
                'end_time' => 'required',


            ],

        );

        time_schedules::find($id)->update([
            'sart_time' => $request->sart_time,
            'end_time' => $request->end_time,

            'updated_at' => Carbon::now(),
        ]);
        return back()->with('upd', 'Succeefully Updated');
    }

    public function doctor_patient_review()
    {

        $d_id = Doctor::where('doctor_id', auth()->user()->id)->get();
        $d_list = $d_id->count();
        if ($d_list == '0') {

            return view('Fonend.DoctoDash.Doctor_dash.doctor_patient_reviwes', compact('d_list'));
        } else {
            $doctor_ids =  $d_id[0]->id;
            $doctor_id = User::find(auth()->user()->id);


            $review = $doctor_id->relationWithDoctor->relationWithReviewDoctor()->latest()->get();


            return view('Fonend.DoctoDash.Doctor_dash.doctor_patient_reviwes', compact('review', 'doctor_ids', 'd_list'));
        }
    }

    public function  doctor_patient_review_replay($id)
    {

        $patient_id = $id;

        return view('Fonend.DoctoDash.Doctor_dash.patient_review_replay', compact('patient_id'));
    }

    public function doctor_patient_review_replay_add(Request $request)
    {


        $request->validate([

            'title' => 'required|max:35',
            'comment' => 'required|max:100'
        ]);




        Replay::insert([


            'doctor_id' => $request->p_id,

            'title' => $request->title,
            'comment' => $request->comment,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }

    public function  doctor_patient_prescription($id)
    {
        $p_id = $id;

        $doctor = Doctor::where('doctor_id', auth()->user()->id)->get();
        return view('Fonend.DoctoDash.Doctor_dash.doctor_prescription', compact('p_id', 'doctor'));
    }

    public function  doctor_patient_prescription_add(Request $request)
    {



        $request->validate([
            'Symptoms' => 'required',
            'medicine_name' => 'required',
            'medicine_time' => 'required',
            'meal' => 'required',
            'days' => 'required',

        ]);


        $test_id = patient_test::insertGetId([
            'p_id' => $request->p_id,
            'd_id' => auth()->user()->id,
            'Symptoms' => $request->Symptoms,
            'tests' => $request->tests ?? 'No Tests Suggest',
            'Advice' => $request->Advice ?? 'No Advice Suggest',
            'created_at' => Carbon::now(),
        ]);




        $medicineData = $request->all();
        // Check if the array exists and is not null
        if (isset($medicineData['medicine_name'])) {
            $medicineCount = count($medicineData['medicine_name']);

            for ($i = 0; $i < $medicineCount; $i++) {
                // Check if the specific elements exist and are not null
                if (isset($medicineData['medicine_name'][$i]) && isset($medicineData['medicine_time'][$i]) && isset($medicineData['meal'][$i]) && isset($medicineData['days'][$i])) {



                    // Check if 'Symptoms' key exists
                    $symptoms = isset($medicineData['Symptoms'][$i]) ? $medicineData['Symptoms'][$i] : null;

                    DB::table('prescriptions')->insert([
                        'medicine_name' => $medicineData['medicine_name'][$i],
                        'medicine_time' => $medicineData['medicine_time'][$i],
                        'meal' => $medicineData['meal'][$i],
                        'days' => $medicineData['days'][$i],

                        'test_id' => $test_id,
                        'created_at' => Carbon::now(),
                    ]);
                }
            }
        }



        return back()->with('suc', 'Succeefully Added!');
    }



















    public function patient_prescription_view($id)
    {

        $prescprition = patient_test::where('p_id', $id)->get();
        if ($prescprition->count() == 0) {
            return "njnnj";
        } else {
            return view('Fonend.DoctoDash.Doctor_dash.patient_prescprition', compact('prescprition'));
        }
    }
}
