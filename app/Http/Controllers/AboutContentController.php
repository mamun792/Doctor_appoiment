<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutContent;

class AboutContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aboutContents = AboutContent::all();
        return view('Backhands.About.index', compact('aboutContents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('about.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required'
        ], [
            'content.required' => 'The content field is required.'
        ]);
        $aboutContent = new AboutContent();
        $aboutContent->content = $request->input('content');
        $aboutContent->save();

        return back()->with('success', 'About content created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
     $aboutContent = AboutContent::all();
        return view('Backhands.About.bout_show', compact('aboutContent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aboutContent = AboutContent::findOrFail($id);
        return view('about.edit', compact('aboutContent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $aboutContent = AboutContent::findOrFail($id);
        $aboutContent->content = $request->input('content');
        $aboutContent->save();

        return  back()->with('success', 'About content updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aboutContent = AboutContent::findOrFail($id);
        $aboutContent->delete();

        return back()->with('Delete', 'About content deleted successfully');
    }
}
