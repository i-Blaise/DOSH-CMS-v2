<?php

namespace App\Http\Controllers\ServiceProvidersPage;

use App\Http\Controllers\Controller;
use App\Models\ServiceProvidersTitles;
use Illuminate\Http\Request;

class HSPsController extends Controller
{
        public function pageTitles()
    {
        $titles = ServiceProvidersTitles::find(1);
        return view('dashboard.pages.serviceproviders.hsp-title-section', [
            'titles' => $titles
        ]);
    }

        public function updatePageTitles(Request $request)
    {
        $request->validate([
            'title' => 'required|max:200',
            'sub_title' => 'required|max:300',
        ]);

        $titles = ServiceProvidersTitles::find(1);
        $titles->title = $request->input('title');
        $titles->sub_title = $request->input('sub_title');

        $titles->save();
        logActivity("Updated Service Providers Page Titles");

        return back()->with(
            'success', 'Title Updated Successfully');
    }
}
