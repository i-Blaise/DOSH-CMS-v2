<?php

namespace App\Http\Controllers\ServiceProvidersPage;

use App\Http\Controllers\Controller;
use App\Models\ServiceProvidersHeader;
use Illuminate\Http\Request;

class ServiceProvidersHeaderController extends Controller
{
        public function index()
    {
        $header = ServiceProvidersHeader::find(1);
        return view('dashboard.pages.serviceproviders.header', [
            'header' => $header
        ]);
    }


        public function storeServiceProvidersHeader(Request $request)
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

        // dd($request->input('caption'));

        $header = ServiceProvidersHeader::find(1);
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

}
