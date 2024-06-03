<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Slideshow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SlideshowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slideshow::all();
        return view('dashboard.pages.homepage.slideshow')
               ->with('sliders', $sliders);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sliders = Slideshow::all();
        return view('dashboard.pages.homepage.slideshow')
               ->with('sliders', $sliders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'slideshow_image' => 'required|mimes:jpg,webp,png,jpeg',
            'caption' => 'required|max:100',
            'body' => 'required|max:200',
        ]);

        $slider_image_path = $this->uploadProfileImage($request->file('slideshow_image'));

        $sliders = new Slideshow();
        $sliders->slideshow_image = $slider_image_path;
        $sliders->caption = $request->input('caption');
        $sliders->body = $request->input('body');
        $sliders->uploaded_by = Auth::user()->name;

        $sliders->save();
        return back()->with('success', 'Slideshow updated successfully');
    }


    public function uploadProfileImage($imageFile): string
    { //Move Uploaded File to public folder
        $destinationPath = 'images/uploads/slideshow/';
        $hashed_image_name = $imageFile->hashName();
        $profile_img_path = $destinationPath.$hashed_image_name;
        $imageFile->move(public_path($destinationPath), $hashed_image_name);

        return $profile_img_path;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Slideshow::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Team Card Deleted');
    }
}
