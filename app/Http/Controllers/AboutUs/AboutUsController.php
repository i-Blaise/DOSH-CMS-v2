<?php

namespace App\Http\Controllers\AboutUs;

use App\Models\AboutUs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AboutUs $aboutUs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $section)
    {
        $sections = ['header', 'whoweare', 'mission', 'values', 'expertise', 'inspiration', 'banner'];
        if(!in_array($section, $sections))
        {
            return back()->with('info', 'no');
        }
        $aboutUsSections = AboutUs::all();
        return view('dashboard.pages.aboutus.index', [
            'aboutUsSections' => $aboutUsSections,
            'section' => $section
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $section)
    {
        // dd($request->file('aboutus_section_image'));
        if($section == 'header'|| $section == 'banner')
        {
            $request->validate([
                'aboutus_section_image' => 'nullable|mimes:jpg,webp,png,jpeg'
            ]);
        }else{
            $request->validate([
                'aboutus_section_image' => 'nullable|mimes:jpg,webp,png,jpeg',
                'caption' => 'required',
                'body' => 'required',
            ]);
        }


        if(!is_null($request->file('aboutus_section_image')))
        {
            $imagePath = $this->uploadProfileImage($request->file('aboutus_section_image'));
        }
        // dd($imagePath);

        $aboutus_section = AboutUs::find(1);

        switch($section) {
            case 'header':
                !isset($imagePath) ?
                '' : $aboutus_section->aboutus_header_image = $imagePath;
                break;
            case 'banner':
                !isset($imagePath) ?
                '' : $aboutus_section->banner_image = $imagePath;
                break;
            case 'whoweare':
                !isset($imagePath) ?
                '' : $aboutus_section->who_we_are_image = $imagePath;
                $aboutus_section->who_we_are_caption = $request->input('caption');
                $aboutus_section->who_we_are_body = $request->input('body');
                break;

            case 'mission':
                !isset($imagePath) ?
                '' : $aboutus_section->mission_image = $imagePath;
                $aboutus_section->mission_caption = $request->input('caption');
                $aboutus_section->mission_body = $request->input('body');
                break;

            case 'values':
                !isset($imagePath) ?
                '' : $aboutus_section->values_image = $imagePath;
                $aboutus_section->values_caption = $request->input('caption');
                $aboutus_section->values_body = $request->input('body');
                break;

            case 'expertise':
                $aboutus_section->expertise_caption = $request->input('caption');
                $aboutus_section->expertise_body = $request->input('body');
                break;

            case 'inspiration':
                $aboutus_section->inspiration_caption = $request->input('caption');
                $aboutus_section->inspiration_body = $request->input('body');
                break;
        }

        $aboutus_section->save();
        return back()
        ->with('success', ucfirst($section).' Section Successfully Updated');
    }

    public function uploadProfileImage($imageFile): string
    { //Move Uploaded File to public folder
        $destinationPath = 'images/uploads/aboutus-sections/';
        $hashed_image_name = $imageFile->hashName();
        $profile_img_path = $destinationPath.$hashed_image_name;
        $imageFile->move(public_path($destinationPath), $hashed_image_name);

        return $profile_img_path;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AboutUs $aboutUs)
    {
        //
    }
}
