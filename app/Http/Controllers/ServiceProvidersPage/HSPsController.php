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
        $countries = [
        'Afghanistan', 'Albania', 'Algeria', 'Andorra', 'Angola',
        'Antigua and Barbuda', 'Argentina', 'Armenia', 'Australia', 'Austria',
        'Azerbaijan', 'Bahamas', 'Bahrain', 'Bangladesh', 'Barbados',
        'Belarus', 'Belgium', 'Belize', 'Benin', 'Bhutan', 'Bolivia',
        'Bosnia and Herzegovina', 'Botswana', 'Brazil', 'Brunei', 'Bulgaria',
        'Burkina Faso', 'Burundi', 'Cabo Verde', 'Cambodia', 'Cameroon',
        'Canada', 'Central African Republic', 'Chad', 'Chile', 'China',
        'Colombia', 'Comoros', 'Congo (Congo-Brazzaville)',
        'Costa Rica', 'Croatia', 'Cuba', 'Cyprus', 'Czech Republic',
        'Democratic Republic of the Congo', 'Denmark', 'Djibouti', 'Dominica',
        'Dominican Republic', 'Ecuador', 'Egypt', 'El Salvador',
        'Equatorial Guinea', 'Eritrea', 'Estonia', 'Eswatini', 'Ethiopia',
        'Fiji', 'Finland', 'France', 'Gabon', 'Gambia', 'Georgia', 'Germany',
        'Ghana', 'Greece', 'Grenada', 'Guatemala', 'Guinea', 'Guinea-Bissau',
        'Guyana', 'Haiti', 'Honduras', 'Hungary', 'Iceland', 'India',
        'Indonesia', 'Iran', 'Iraq', 'Ireland', 'Israel', 'Italy', 'Jamaica',
        'Japan', 'Jordan', 'Kazakhstan', 'Kenya', 'Kiribati', 'Kuwait',
        'Kyrgyzstan', 'Laos', 'Latvia', 'Lebanon', 'Lesotho', 'Liberia',
        'Libya', 'Liechtenstein', 'Lithuania', 'Luxembourg', 'Madagascar',
        'Malawi', 'Malaysia', 'Maldives', 'Mali', 'Malta',
        'Marshall Islands', 'Mauritania', 'Mauritius', 'Mexico',
        'Micronesia', 'Moldova', 'Monaco', 'Mongolia', 'Montenegro',
        'Morocco', 'Mozambique', 'Myanmar', 'Namibia', 'Nauru', 'Nepal',
        'Netherlands', 'New Zealand', 'Nicaragua', 'Niger', 'Nigeria',
        'North Korea', 'North Macedonia', 'Norway', 'Oman', 'Pakistan',
        'Palau', 'Palestine State', 'Panama', 'Papua New Guinea', 'Paraguay',
        'Peru', 'Philippines', 'Poland', 'Portugal', 'Qatar', 'Romania',
        'Russia', 'Rwanda', 'Saint Kitts and Nevis', 'Saint Lucia',
        'Saint Vincent and the Grenadines', 'Samoa', 'San Marino',
        'Sao Tome and Principe', 'Saudi Arabia', 'Senegal', 'Serbia',
        'Seychelles', 'Sierra Leone', 'Singapore', 'Slovakia', 'Slovenia',
        'Solomon Islands', 'Somalia', 'South Africa', 'South Korea',
        'South Sudan', 'Spain', 'Sri Lanka', 'Sudan', 'Suriname',
        'Sweden', 'Switzerland', 'Syria', 'Taiwan', 'Tajikistan', 'Tanzania',
        'Thailand', 'Timor-Leste', 'Togo', 'Tonga', 'Trinidad and Tobago',
        'Tunisia', 'Turkey', 'Turkmenistan', 'Tuvalu', 'Uganda', 'Ukraine',
        'United Arab Emirates', 'United Kingdom', 'United States', 'Uruguay',
        'Uzbekistan', 'Vanuatu', 'Vatican City', 'Venezuela', 'Vietnam',
        'Yemen', 'Zambia', 'Zimbabwe'
        ];
        return view('dashboard.pages.serviceproviders.hsp-create', [
            'ghanaRegions' => $regions,
            'countries' => $countries,
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
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


    public function edit($id)
    {
        $hsp = HSP::findOrFail($id);
        $regions = HSP::select('region_name')->distinct()->get();
        $countries = [
            'Afghanistan', 'Albania', 'Algeria', 'Andorra', 'Angola',
            'Antigua and Barbuda', 'Argentina', 'Armenia', 'Australia', 'Austria',
            'Azerbaijan', 'Bahamas', 'Bahrain', 'Bangladesh', 'Barbados',
            'Belarus', 'Belgium', 'Belize', 'Benin', 'Bhutan', 'Bolivia',
            'Bosnia and Herzegovina', 'Botswana', 'Brazil', 'Brunei', 'Bulgaria',
            'Burkina Faso', 'Burundi', 'Cabo Verde', 'Cambodia', 'Cameroon',
            'Canada', 'Central African Republic', 'Chad', 'Chile', 'China',
            'Colombia', 'Comoros', 'Congo (Congo-Brazzaville)',
            'Costa Rica', 'Croatia', 'Cuba', 'Cyprus', 'Czech Republic',
            // ... (rest of the countries)
        ];

        return view('dashboard.pages.serviceproviders.hsp-edit')->with([
            "hsp" => $hsp,
            "ghanaRegions" => $regions,
            "countries" => $countries
        ]);
    }
    public function update(Request $request, $id)
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

        HSP::where('id', $id)->update($validated);

        logActivity("Updated HSP with ID: " . $id);

        return redirect()->route('hsp-list')->with('success', 'HSP updated successfully!');
    }
    public function destroy($id)
    {
        $hsp = HSP::findOrFail($id);
        $hsp->delete();

        logActivity("Deleted HSP with ID: " . $id);

        return redirect()->route('hsp-list')->with('success', 'HSP deleted successfully!');
    }

}
