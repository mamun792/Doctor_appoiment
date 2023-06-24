<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\_specilest;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Featured_photo;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\returnSelf;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $doctor = User::where('login_id', auth()->id())->latest()->get();
        return view('Backhands.doctor.index', compact('doctor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $speci = _specilest::all();
        $doc = User::where('id', auth()->id())->get();
        $vendor = User::where('login_id', auth()->id())->get();

        //   return view('Fonend.Doctor_dash.create', compact('speci', 'vendor'));
        return view('Backhands.doctor.create', compact('speci', 'vendor', 'doc'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //    return $request->vendor_id;

        $request->validate(
            [
                'fname' => 'required|max:20',
                'lname' => 'required|max:5',

                'country_code' => 'required|in:+880', // Validating for Bangladesh country code
                'phone_number' => 'required|digits:11',
                'price' => 'required',
                'city' => 'required',
                'degree' => 'required',
                'hospital_address' => 'required',
                'locations' => 'required',
                'about' => 'required',
                'fillinges' => 'required',
                'year_of_completion' => 'required',
                'special_id' => 'required',
                'doctor_themble_photo' => 'required|image',
               'doctors_features_photos.*' => 'required|image|mimes:jpeg,png|max:2048',
                'vendor_id' => 'required',

            ],[
                'country_code.required' => 'Country code is required.',
                'country_code.in' => 'Invalid country code.',
                'phone_number.required' => 'Phone number is required.',
                'phone_number.digits' => 'Invalid phone number.',
            ]
        );







        $doctor_id = Doctor::insertGetId([
            'special_id' => $request->special_id,
            'vendor_id' => auth()->id(),
            'doctor_id' => $request->vendor_id,

            'fname' => $request->fname,
            'lname' => $request->lname,

            'price' => $request->price,
            'city' => $request->city,


            'locations' => $request->locations,
            'about' => $request->about,
            'doctor_themble_photo' => "images.jpeg",
            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'hospital_name' => $request->fillinges,

            'hospital_address' => $request->hospital_address,

            'degree' => $request->degree,
            'college' => $request->college,
            'year_of_completion' => $request->year_of_completion,
            'dwards' => $request->dwards,
            'year' => $request->year,
            'registrations' => $request->registrations,

            'year_of_registrations' => $request->year_of_registrations,
            'created_at' => Carbon::now(),
        ]);



        $exteion_name = Str::random(20) . "." . $request->file('doctor_themble_photo')->getClientOriginalExtension();
        $path = 'uploads/doctor_themble_photo/' . $exteion_name;
        Image::make($request->file('doctor_themble_photo'))->text('DLPCMS', 10, 20, function ($font) {
            $font->size(450);
            $font->color(255, 255, 255, 1);
            $font->align('center');
            $font->valign('top');
            $font->angle(45);
        })->resize(300, 300)->save($path);

        Doctor::find($doctor_id)->update([
            'doctor_themble_photo' => $exteion_name,
        ]);

        //doctors_features_photos uploadstart
        foreach ($request->doctors_features_photos as $doctors_features_photo) {
            // $doctor_id
            $exteion_name = $doctor_id . "--" . Str::random(20) . "." . $doctors_features_photo->extension();
            $path = 'uploads/doctors_features_photos/' . $exteion_name;
            Image::make($doctors_features_photo)->text('DLPCMS', 10, 20, function ($font) {
                $font->size(450);
                $font->color(255, 255, 255, 1);
                $font->align('center');
                $font->valign('top');
                $font->angle(45);
            })->resize(300, 200)->save($path);

            Featured_photo::insert([
                'doctor_id' => $doctor_id,
                'featured_photos_name' => $exteion_name,
                'created_at' => Carbon::now(),

            ]);
        }

        //doctors_features_photos end
        return back()->with('succ', "Succeefully Doctors Added!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {

        return view('Backhands.doctor.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        return view('Backhands.doctor.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        // return view('Fonend.Doctor_dash.update');
        //return"hjn";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        //
    }
}
