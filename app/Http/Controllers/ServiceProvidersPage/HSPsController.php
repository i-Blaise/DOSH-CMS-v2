<?php

namespace App\Http\Controllers\ServiceProvidersPage;

use App\Http\Controllers\Controller;
use App\Models\HSP;
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


    public function hspList(Request $request)
    {
        $query = HSP::query();

        if ($request->filled('country')) {
            $query->where('country', $request->input('country'));
        }

        if ($request->filled('region')) {
            $query->where('region_name', $request->input('region'));
        }

        $hsp = $query->get();
        $countries = HSP::select('country')->distinct()->get();
        $regions = HSP::select('region_name')->distinct()->get();

        return view('dashboard.pages.serviceproviders.hsp-list', [
            'hsp' => $hsp,
            'countries' => $countries,
            'regions' => $regions,
        ]);
    }

}
