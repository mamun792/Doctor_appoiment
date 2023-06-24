<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\_specilest;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use Carbon\carbon;
use Symfony\Contracts\Service\Attribute\Required;

class SpecialitieController extends Controller
{
    public function special()
    {
        $speci = _specilest::all();
        return view('Backhands.Specialitie.special_doctor', compact('speci'));
    }



    public function insert(Request $request)
    {

        $request->validate(
            [
                'special' => 'required|max:30|unique:_specilests,special',
                'category_photo' => 'image',

            ],
            [
                'special.required' => 'Specliest Name is Required!',

            ]
        );
        $generate_password = "#SP" . rand(00, 10000);
        $category = _specilest::insertGetId($request->except('_token') + [
            'SI' => $generate_password,
            'created_at' => Carbon::now(),
        ]);

        if ($request->hasfile('category_photo')) {
            $exteion_name = Str::random(20) . "." . $request->file('category_photo')->getClientOriginalExtension();
            $path = 'uploads/special_photp/' . $exteion_name;
            Image::make($request->file('category_photo'))->save($path);

            _specilest::find($category)->update([
                'category_photo' => $exteion_name,
            ]);
        }

        return back()->with('Success', 'Speclist Succeefully Added!');
    }

    public function delete($restor_id)
    {
        _specilest::find($restor_id)->forceDelete();
        return back()->with('delete', 'Speclist Succeefully Delete!');
    }

    public function edit($update_id)
    {

        $update = _specilest::find($update_id);
        return view('Backhands.Specialitie.update', compact('update'));
    }

    public function Updates(Request $request, $update_id)
    {

        $request->validate(
            [

                'category_photo' => 'image',

            ],

        );
        if ($request->hasfile('category_photo')) {

            $catego = _specilest::find($update_id);



            if ($catego->category_photo == "images.jpeg") {
                $exteion_name = Str::random(20) . "." . $request->file('category_photo')->getClientOriginalExtension();
                $path = 'uploads/special_photp/' . $exteion_name;

                Image::make($request->file('category_photo'))->save($path);
                _specilest::find($update_id)->update([
                    'category_photo' => $exteion_name,
                ]);
            } else {
                $delete = public_path('uploads/special_photp/') . $catego->category_photo;
                unlink($delete);
                $exteion_name = Str::random(20) . "." . $request->file('category_photo')->getClientOriginalExtension();
                $path = 'uploads/special_photp/' . $exteion_name;
                Image::make($request->file('category_photo'))->save($path);

                _specilest::find($update_id)->update([
                    'category_photo' => $exteion_name,
                ]);
            }
        }
        _specilest::find($update_id)->update([
            'special' => $request->special,

        ]);
        return back()->with('Success', 'Speclist Succeefully Updated!');
    }
}
