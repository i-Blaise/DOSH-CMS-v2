<?php

namespace App\Http\Controllers\ContactPage;

use App\Http\Controllers\Controller;
use App\Models\ContactPage;
use Illuminate\Http\Request;

class ContactPageController extends Controller
{
    function index()
    {
        $header = ContactPage::find(1);
        return view('dashboard.pages.contactpage.header', [
            'header' => $header
        ]);
    }


    public function storeContactPageHeader(Request $request)
    {
        $request->validate([
            'image' => 'nullable|mimes:jpg,webp,png,jpeg',
            'caption' => 'required',
            'body' => 'nullable',
        ]);

        if(!is_null($request->file('image')))
        {
            $imagePath = $this->uploadProfileImage($request->file('image'));
        }

        // dd($request->input('body'));

        $header = ContactPage::find(1);
        !isset($imagePath) ?
        '' : $header->header_image = $imagePath;
        $header->header_caption = $request->input('caption');
        $header->header_body = !is_null($request->input('body')) ? $request->input('body') : '';

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
}