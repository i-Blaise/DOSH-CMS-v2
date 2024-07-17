<?php

namespace App\Http\Controllers\PnS;

use App\Http\Controllers\Controller;
use App\Models\PnSHeader;
use App\Models\PnSHeaderPreview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PnSHeaderController extends Controller
{
    public function index()
    {
        $header = PnSHeader::find(1);
        return view('dashboard.pages.pns.header')
               ->with('header', $header);
    }

    public function submitToPreview(Request $request, int $id)
    {
        dd('good');
        $request->validate([
            'image' => 'nullable|mimes:jpg,webp,png,jpeg',
            'caption' => 'required|max:200',
            'body' => 'nullable|max:300',
        ]);

        if(!is_null($request->file('image')))
        {
            $imagePath = $this->uploadProfileImage($request->file('image'));
        }

        $pns_header_preview = PnSHeaderPreview::find($id);
        !isset($imagePath) ?
        '' : $pns_header_preview->image = $imagePath;
        $pns_header_preview->caption = $request->input('caption');
        $pns_header_preview->body = $request->input('body');

        $pns_header_preview->save();
        return View::make('dashboard.pages.preview.index',
        ['header' => $pns_header_preview]);
    }

    public function uploadProfileImage($imageFile): string
    { //Move Uploaded File to public folder
        $destinationPath = 'images/uploads/pns-header/';
        $hashed_image_name = $imageFile->hashName();
        $profile_img_path = $destinationPath.$hashed_image_name;
        $imageFile->move(public_path($destinationPath), $hashed_image_name);

        return $profile_img_path;
    }
}
