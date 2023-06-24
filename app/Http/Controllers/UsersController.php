<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountCreation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Doctor;

class UsersController extends Controller
{
    public function users()
    {


         $user = User::where('login_id', auth()->user()->id)->get();
          return view('Backhands.User.index', compact('user'));

    }

    public function add_user()
    {
        if (auth()->user()->role == 'vendor') {
            return view('Backhands.Vendor_dashboard.User.Add_user');
        } else {
            return view('Backhands.User.Add_user');
        }
    }
    public function insert(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:30',
                'email' => 'required|unique:users,email',
                'phone_number' => 'required|unique:users,phone_number',
                'country_code' => 'required|in:+880',
                'role' => 'required',
                'profile_photo' => 'image',

            ],
            [
                'name.required' => ' Name is Required!',
                'email.required' => ' Email is Required!',
                'role.required' => ' Role is Required!',

            ]
        );
        $generates_id = "#INV" . "-" . rand(0000, 1000000);
        $generate_password = Str::random(8);
        $user_id = User::insertGetId([
            'p_id' => $generates_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => bcrypt($generate_password),
            'created_at' => Carbon::now(),
            'role' => $request->role,
            'login_id' => auth()->id(),
        ]);
        if ($request->hasFile('profile_photo')) {
            //image add
            $exteion_name = Str::random(20) . "." . $request->file('profile_photo')->getClientOriginalExtension();
            $path = 'uploads/profile_photo/' . $exteion_name;
            Image::make($request->file('profile_photo'))->save($path);

            User::find($user_id)->update([
                'profile_photo' => $exteion_name,
            ]);
        }
        // email_send_start

        $info = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $generate_password,

            'role' => $request->role,

        ];
        Mail::to($request->email)->send(new AccountCreation($info));
        //email_sent_end
        return back()->with('adds', 'succeefully add user');
    }

    public function vendor_delete($id)
    {
        $vendor = User::find($id);
        $doctors = Doctor::where('vendor_id', $id)->get();

        if ($vendor) {
            // Delete the doctors associated with the vendor
            foreach ($doctors as $doctor) {
                $doctor->delete();
            }

            $loginRelationships = $vendor->login_relationships()->get();

            if ($loginRelationships && !$loginRelationships->isEmpty()) {
                foreach ($loginRelationships as $loginRelationship) {
                    $loginRelationship->delete();
                }

                $vendor->forceDelete(); // Permanently delete the vendor
                Session::flash('success_message', 'Vendor and all associated login relationships have been permanently deleted.');
            } else {
                $vendor->forceDelete(); // Permanently delete the vendor
                Session::flash('no_message', 'No login relationships found for the user. Vendor has been permanently deleted.');
            }
        } else {
            return response()->json(['message' => 'User not found.'], 404);
        }
    }



}

