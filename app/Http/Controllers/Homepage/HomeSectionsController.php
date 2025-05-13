<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\HomeSections;
use Illuminate\Http\Request;

class HomeSectionsController extends Controller
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $section)
    {
        // dd($section);
        $sections = ['insurance', 'finance', 'ride', 'erp', 'commerce', 'risk'];
        if(!in_array($section, $sections))
        {
            return back()->with('info', 'Invalid section selected');
        }
        $homeSections = HomeSections::all();
        return view('dashboard.pages.homepage.index', [
            'homeSections' => $homeSections,
            'section' => $section
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $section)
    {
        $request->validate([
            'home_section_image' => 'nullable|mimes:jpg,webp,png,jpeg',
            'caption' => 'required',
            'body' => 'required',
            'modal_body' => 'required'
        ]);

        if(!is_null($request->file('home_section_image')))
        {
            $imagePath = $this->uploadProfileImage($request->file('home_section_image'));
        }

        $home_section = HomeSections::first();

        switch($section) {
            case 'insurance':
                !isset($imagePath) ?
                '' : $home_section->insurance_image = $imagePath;
                $home_section->insurance_caption = $request->input('caption');
                $home_section->insurance_body = $request->input('body');
                $home_section->insurance_modal_body = $request->input('modal_body');
                break;

            case 'finance':
                !isset($imagePath) ?
                '' : $home_section->finance_image = $imagePath;
                $home_section->finance_caption = $request->input('caption');
                $home_section->finance_body = $request->input('body');
                $home_section->finance_modal_body = $request->input('modal_body');
                break;

            case 'ride':
                !isset($imagePath) ?
                '' : $home_section->ride_image = $imagePath;
                $home_section->ride_caption = $request->input('caption');
                $home_section->ride_body = $request->input('body');
                $home_section->ride_modal_body = $request->input('modal_body');
                break;

            case 'erp':
                !isset($imagePath) ?
                '' : $home_section->erp_image = $imagePath;
                $home_section->erp_caption = $request->input('caption');
                $home_section->erp_body = $request->input('body');
                $home_section->erp_modal_body = $request->input('modal_body');
                break;

            case 'commerce':
                !isset($imagePath) ?
                '' : $home_section->commerce_image = $imagePath;
                $home_section->commerce_caption = $request->input('caption');
                $home_section->commerce_body = $request->input('body');
                $home_section->commerce_modal_body = $request->input('modal_body');
                break;

            case 'risk':
                !isset($imagePath) ?
                '' : $home_section->risk_image = $imagePath;
                $home_section->risk_caption = $request->input('caption');
                $home_section->risk_body = $request->input('body');
                $home_section->risk_modal_body = $request->input('modal_body');
                break;
        }

        $home_section->save();
        // Log the activity
        logActivity("Updated Home Page $section Section");

        return back()
        ->with('success', ucfirst($section).' Section Successfully Updated');
    }

    public function uploadProfileImage($imageFile): string
    { //Move Uploaded File to public folder
        $destinationPath = 'images/uploads/home-sections/';
        $hashed_image_name = $imageFile->hashName();
        $profile_img_path = $destinationPath.$hashed_image_name;
        $imageFile->move(public_path($destinationPath), $hashed_image_name);

        return $profile_img_path;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
