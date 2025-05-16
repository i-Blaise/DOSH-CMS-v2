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



    public function createHSP()
    {

        $regions = HSP::select('region_name')->distinct()->get();
        return view('dashboard.pages.serviceproviders.hsp-create', [
            'ghanaRegions' => $regions,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'hospital_name' => 'required|string|max:255',
            'country' => 'required|string|max:100',
            'region_name' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'phone_number1' => 'nullable|string|max:20',
            'phone_number2' => 'nullable|string|max:20',
            'phone_number3' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'latitude' => 'nullable|string|max:50',
            'longitude' => 'nullable|string|max:50',
            'location_address' => 'nullable|string|max:255',
        ]);

        if (!$validated['location_address'] && $validated['latitude'] && $validated['longitude']) {
            $lat = str_replace('°', '', $validated['latitude']);
            $lng = str_replace('°', '', $validated['longitude']);
            $validated['location_address'] = "https://www.google.com/maps?q=" . urlencode("{$lat},{$lng}");
        }

        HSP::create($validated);

        logActivity("Created new HSP: " . $validated['hospital_name']);

        return redirect()->route('hsp-list')->with('success', 'New HSP added successfully!');
    }

}
