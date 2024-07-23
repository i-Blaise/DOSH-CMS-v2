<?php

namespace App\Http\Controllers\PnS;

use App\Http\Controllers\Controller;
use App\Models\PnSHeader;
use App\Models\PnSHeaderPreview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PnSHeaderController extends Controller
{
    public function index($status = null)
    {
        $header = PnSHeader::find(1);
        $headerPreview = PnSHeaderPreview::first();
        return view('dashboard.pages.pns.header', [
            'header' => $header,
            'headerPreview' => $headerPreview,
            'status' => $status
        ]);
    }

    public function submitToPreview(Request $request)
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

        $pns_header_preview = new PnSHeaderPreview;
        !isset($imagePath) ?
        '' : $pns_header_preview->image = $imagePath;
        $pns_header_preview->caption = $request->input('caption');
        $pns_header_preview->body = !is_null($request->input('body')) ? $request->input('body') : '';

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



    public function previewToHeaderPnS()
    {
        // dd('check');
        $header = PnSHeader::find(1);
        $headerPreview = PnSHeaderPreview::first();

        !is_null($headerPreview->image) ? $header->image = $headerPreview->image : '';
        !is_null($headerPreview->caption) ? $header->caption = $headerPreview->caption : '';
        !is_null($headerPreview->body) ? $header->body = $headerPreview->body : '';

        $header->save();
        $headerPreview->delete();

        return redirect()->route('pns-header')->with(
            'header', $header,
            'success', 'Header Updated Successfully',
            'status', null
        );

        // return view('dashboard.pages.pns.header', [
        //     'header' => $header,
        //     'success' => 'Header Updated Successfully',
        //     'status' => null,
        // ]);
    }
}
