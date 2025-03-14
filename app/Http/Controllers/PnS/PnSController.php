<?php

namespace App\Http\Controllers\PnS;

use App\Http\Controllers\Controller;
use App\Models\PnSHeader;
use App\Models\DoshInsurance;
use App\Models\InsuranceReadMoreModal;
use App\Models\PnSPage;
use Illuminate\Http\Request;

class PnSController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($status = null)
    {
        $header = PnSHeader::find(1);
        return view('dashboard.pages.pns.header', [
            'header' => $header
        ]);
    }

    public function storePnSHeader(Request $request)
    {
        $request->validate([
            'image' => 'nullable|mimes:jpg,webp,png,jpeg',
            'caption' => 'required|max:200',
            'body' => 'nullable|max:300',
        ]);

        if(!is_null($request->file('image')))
        {
            $imagePath = $this->uploadProfileImage($request->file('image'));
        }

        // dd($request->input('body'));

        $header = PnSHeader::find(1);
        !isset($imagePath) ?
        '' : $header->image = $imagePath;
        $header->caption = $request->input('caption');
        $header->body = !is_null($request->input('body')) ? $request->input('body') : '';

        $header->save();

        return back()->with(
            'success', 'Header Updated Successfully');
    }

    public function uploadProfileImage($imageFile): string
    { //Move Uploaded File to public folder
        $destinationPath = 'images/uploads/pns/';
        $hashed_image_name = $imageFile->hashName();
        $profile_img_path = $destinationPath.$hashed_image_name;
        $imageFile->move(public_path($destinationPath), $hashed_image_name);

        return $profile_img_path;
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
    public function edit(?string $name = null, ?string $type = null)
    {

        if($name == 'insurance' || $name == 'financial')
        {
            $pns_page = DoshInsurance::where('insurance_type', $name)->first();
        }elseif($name == 'readmore'){
            $pns_page = InsuranceReadMoreModal::where('insurance_name', $type)->first();
        }else{
            $name = is_null($name) ? '365' : $name;
            $pns_page = DoshInsurance::where('insurance_name', $name)->get();
        }

        return view('dashboard.pages.pns.pns-sections', [
            'pns_page' => $pns_page
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,webp,png,jpeg,jpg file|max:2048',
            'caption' => 'nullable',
            'body' => 'nullable',
            'description' => 'nullable',
            'references' => 'nullable',
        ]);

        if(!is_null($request->file('image')))
        {
            $imagePath = $this->uploadProfileImage($request->file('image'));
        }

        // dd($request->input('submit'));

        if($request->input('submit') == 'financial'|| $request->input('submit') == 'insurance')
        {
            $insurance = DoshInsurance::where('insurance_type', $request->input('submit'))->first();

            $insurance->home_caption = $request->input('caption');
            $insurance->home_body = $request->input('body');
            !isset($imagePath) ?
            '' : $insurance->home_image = $imagePath;

            $insurance->save();

            return back()->with('success', 'Update Successful');
        }elseif($request->input('submit') == 'readmore'){
            if($request->input('type') == 'health'){
                $insurance_readmore_modal = InsuranceReadMoreModal::find(1);
                !isset($imagePath) ?
                '' : $insurance_readmore_modal->image = $imagePath;
                $insurance_readmore_modal->description = $request->input('description');
                $insurance_readmore_modal->references = $request->input('references');

                $insurance_readmore_modal->save();

                return back()->with('success', 'Update Successful');
            }
        }else{

            $insurance = DoshInsurance::where('insurance_name', $request->input('submit'))->first();
            !isset($imagePath) ?
            '' : $insurance->image = $imagePath;
            $insurance->desc = $request->input('body');

            $insurance->save();

            return back()->with('success', 'Update Successful');
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
