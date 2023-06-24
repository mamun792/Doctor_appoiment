<?php

namespace App\Http\Controllers;

use App\Models\_specilest;
use App\Models\Adderss;
use App\Models\Doctor;
use App\Models\Favourit;
use App\Models\User;
use App\Models\Invoice;
use Illuminate\Support\Str;
use App\Models\time_schedules;
use App\Models\Profile_detiel;
use App\Models\Featured_photo;
use App\Models\Review;
use App\Models\AboutContent;
use App\Models\TimeDuration;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\DB;
use QueryBuilder;

use function PHPUnit\Framework\returnSelf;

class FrontendController extends Controller
{
    public function index()
    {

        $specilest = _specilest::latest()->get();
         $doctor = Doctor::latest()->get();
        $review = Review::all();
      $aboutContent = AboutContent::latest()->first();


      $review_count =   $review->count();
        if (  $review->count() =='0') {

            return view('Fonend.index', compact('specilest', 'doctor', 'review_count','review','aboutContent'));
        } else {

            return view('Fonend.index', compact('specilest', 'doctor', 'review_count','review','aboutContent'));
        }
    }




    public function getDoctors(Request $request, $specialistId = null)
    {
        $doctors = [];


        if ($specialistId) {
            $doctors = Doctor::whereHas('relationwithspeclist', function ($query) use ($specialistId) {
                $query->where('id', $specialistId);
            })->get();
        } else {
            $doctors = Doctor::all();
        }

        return response()->json($doctors);
    }




    public function doctor_profile($id)
    {
        $doctor = Doctor::find($id);
        $review = Review::where('doctor_id', $id)->latest()->get();
        $relationdoctor = $doctor->relationDoctor;
        $related_doctor = Doctor::where('special_id', $doctor->special_id)->where('id', '!=', $id)->get();
        $fecture_photo = Featured_photo::where('doctor_id', $id)->get();
        return view('Fonend.doctor_profile', compact('doctor', 'fecture_photo', 'related_doctor', 'relationdoctor', 'review'));
    }
    public function profile_detals($id)
    {


        $user = User::find($id);

        $us = Profile_detiel::all();
        $profile_det = DB::table('users')->join('profile_detiels', 'users.id', '=', 'profile_detiels.user_id')->where('user_id', $user->id)->get();

        return view('Fonend.patient.patient_profile', compact('profile_det'));
    }

    public function add_favourite($id)
    {

        Favourit::insert([
            'doctor_id' => $id,
            'user_id' => auth()->user()->id,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }

    public function doctor_book_now($id)
    {

        $date = Carbon::now();

        $array = array();
        for ($i = 0; $i < 7; $i++) {
            $array[] = Carbon::now()->addDay($i);
        }
        $a0 = $array[0];
        $a1 = $array[1];
        $a2 = $array[2];
        $a3 = $array[3];
        $a4 = $array[4];
        $a5 = $array[5];
        $a6 = $array[6];

        $doctor = Doctor::find($id);


        $time = $doctor->relationDoctor;



        return view('Fonend.book_now', compact('doctor', 'a0', 'a1', 'a2', 'a3', 'a4', 'a5', 'a6', 'time'));
    }

    public function custom_login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password,])) {
            return back();
        } else {
            return back()->with('login_error', 'email or password is worng');
        }
        //  return $request;
    }

    public function  add_adderess(Request $request)
    {

        $invoices_number = Carbon::now()->format('Y') . "-" . Carbon::now()->format('m') . "-" . Str::upper(Str::random(5));
        $address = Adderss::where('login_id', auth()->id())->get()->count();
        if ($address != 0) {

            $request->validate([
                'lname' => 'required',
                'fname' => 'required',
                'email' => 'required',
                'phone_number' => 'required',
            ]);
            $patient_id = $request->p_id;
            Adderss::find($patient_id)->update([
                'login_id' => auth()->id(),
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'updated_at' => Carbon::now(),

            ]);

            $invoice_id =  Invoice::insertGetId([
                'patient_id' => auth()->id(),
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'invoices_on' => $invoices_number,
                's_total' => session('price'),
                'created_at' => Carbon::now(),
            ]);

            session(['invoice_id' => $invoice_id]);
            return redirect('pay');
            // return back()->with('suc', 'sucessfully added');
        } else {

            $request->validate([
                'lname' => 'required',
                'fname' => 'required',
                'email' => 'required',
                'phone_number' => 'required',
            ]);

            Adderss::insert([
                'login_id' => auth()->id(),
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'created_at' => Carbon::now(),

            ]);

            $invoice_id = Invoice::insertGetId([
                'patient_id' => auth()->id(),
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'invoices_on' => $invoices_number,
                's_total' => session('price'),
                'created_at' => Carbon::now(),
            ]);
            session(['invoice_id' => $invoice_id]);
            return redirect('/pay');
            // return back()->with('suc', 'sucessfully added');
        }
    }

    public function searchs(Request $request)
    {


        $request->validate([
            'search_m' => 'required',
        ], [
            'search_m.required' => 'Please search doctor name',
        ]);



        $tab = Doctor::where('fname', 'like', "%$request->search_m%")->get();
        return view('Fonend.search', compact('tab'));
    }

    public function autocomplete(Request $request)
    {
        $searchQuery = $request->input('query');
        $doctors = Doctor::where('fname', 'like', "$searchQuery%")->pluck('fname');

        return response()->json($doctors);
    }


}
