<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Doctor_detiel;
use App\Models\Profile_detiel;
use App\Models\Invoice;
use App\Models\Invoice_Deatiels;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BackhandController extends Controller
{
    public function dashboard()
    {
        $users = User::all();
        $doctor = Doctor::latest()->get();

        $invices = Invoice_Deatiels::latest()->get();


        $userCounts = User::select('role', DB::raw('count(*) as count'))
            ->groupBy('role')
            ->get()
            ->pluck('count', 'role')
            ->toArray();

        $invoices = Invoice_Deatiels::with('relationInvoice')->latest()->get();

        $revenueByMonth = $invoices->groupBy(function ($invoice) {
            return \Carbon\Carbon::parse($invoice->relationInvoice->created_at)->format('F Y');
        })->map(function ($group) {
            return $group->sum('relationInvoice.s_total');
        });

        return view('Backhands.dashboard', compact('users', 'doctor', 'invices', 'userCounts', 'revenueByMonth'));
    }
    public function patient_list()
    {

        $patient_list =Invoice_Deatiels::latest()->get();
        return view('Backhands.patient.index', compact('patient_list'));
    }

    public function tranjection()
    {

        $invoice_detiles = Invoice_Deatiels::latest()->get();
        return view('Backhands.tranjections.patirnt_tranjection', compact('invoice_detiles'));
    }

    public function  patient_reviews()
    {
        $reviews = Review::all();
        return view('Backhands.review.index', compact('reviews'));
    }
    public function  patient_reviews_delete($review_id)
    {

        Review::destroy($review_id);

        return back()->with('dele', 'Succeefully delete');
    }
    public function  appointment_list()
    {
        $invices = Invoice_Deatiels::all();
        return view('Backhands.appointment.index', compact('invices'));
    }

    public function tranjection_delete($t_id)
    {

        Invoice_Deatiels::destroy($t_id);
        return back()->with('dele', 'Succeefully delete');
    }
    public function search(Request $request)
    {

        $serach = $request->search;


        if ($serach != null) {

            return   $users =  User::where(function ($query) use ($serach) {
                $query->where('name', 'like', '%' . $serach . '%')
                    ->orWhere('p_id', 'like', '%' . $serach . '%');
            })
                ->get();
        } else {
            return "empty";
        }
    }

    public function autocomplete(Request $request)
    {
        $v = $request->search_m;


        $data = User::select("name")
            ->where('name', 'LIKE', '%' . $request->get('query') . '%')
            ->get();


        return response()->json($data);
    }
}
