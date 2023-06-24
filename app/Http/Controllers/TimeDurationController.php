<?php

namespace App\Http\Controllers;

use App\Models\TimeDuration;
use App\Models\User;
use App\Models\Doctor;
use App\Models\time_schedules;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;

class TimeDurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        $request->validate([
            'step' => 'required',
            'day' => 'required',
            'sart_time' => 'required',
            'end_time' => 'required',
        ]);

        TimeDuration::insert([
            'doctor_id' => auth()->user()->id,
            'day' => $request->day,
            'sart_time' => $request->sart_time,
            'end_time' => $request->end_time,
            'step' => $request->step,
            'created_at' => Carbon::now(),
        ]);


        $time_duration = TimeDuration::where('doctor_id', auth()->id())->get();
        $s_time = array();
        $e_time = array();
        foreach ($time_duration as $duration) {
            $sarts_time = $duration->sart_time;
            $end_time =  $duration->end_time;
            $steps = $duration->step;

            $start_times = strtotime($sarts_time);
            $end_time = strtotime($end_time);
            $step =  $steps;
        }
        while ($start_times < $end_time) {
            $s_time = date('g:i A', $start_times);
            $start_times += ($step * 60);
            $e_time = date('g:i A', $start_times);


                time_schedules::insert([
                    'doctor_table_id' => $request->doctor_id,
                    'doctor_login_id' => auth()->user()->id,
                    'sart_time' => $s_time,
                    'end_time' => $e_time,
                    'day' => $request->day,
                    'step' => $request->step,
                    'created_at' => Carbon::now(),
                ]);

        }





        return back()->with('suc_add', 'Succeeefully Added');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TimeDuration  $timeDuration
     * @return \Illuminate\Http\Response
     */
//     public function show()
//     {

//         $time = time_schedules::where('doctor_login_id', auth()->id())->latest()->get();





// //         foreach ($time as $times) {
// //             if ($times->sunday == $times->sunday) {
// //                 echo $times->sart_time;
// //             }else{
// // echo"k,j";
// //             }
// //         }

// //         die();
//         return view('Fonend.DoctoDash.Doctor_dash.doctor_added_time', compact('time'));
//     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TimeDuration  $timeDuration
     * @return \Illuminate\Http\Response
     */
    public function edit(TimeDuration $timeDuration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TimeDuration  $timeDuration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TimeDuration $timeDuration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TimeDuration  $timeDuration
     * @return \Illuminate\Http\Response
     */
    public function destroy(TimeDuration $timeDuration)
    {
        //
    }
}
