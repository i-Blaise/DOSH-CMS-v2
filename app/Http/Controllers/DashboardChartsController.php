<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PageVisit;
use App\Models\UserActivity;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardChartsController extends Controller
{

    public function pageURLsChart()
{
    $pageData = PageVisit::selectRaw('page_url, COUNT(*) as count')
        ->groupBy('page_url')
        ->get()
        ->mapWithKeys(function ($item) {
            $cleanedUrl = str_replace([
                'https://www.0800dosh.me/',
                'https://0800dosh.me/',
                'https://www.0800dosh.me',
                'https://0800dosh.me'
            ], '', $item->page_url);

            return [$cleanedUrl => $item->count];
        });

    return view('dashboard.index', [
        'pageData' => $pageData
    ]);
}














public function visitsThisMonth()
{
    $currentMonth = now()->month;
    $currentYear = now()->year;
    $daysInMonth = now()->daysInMonth;

    // Initialize day → count array
    $uniqueVisitorsPerDay = [];
    for ($day = 1; $day <= $daysInMonth; $day++) {
        $uniqueVisitorsPerDay[$day] = 0;
    }

    // Get all visits in current month
    $visits = PageVisit::selectRaw('DATE(created_at) as date, user_ip')
        ->whereMonth('created_at', $currentMonth)
        ->whereYear('created_at', $currentYear)
        ->get()
        ->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->date)->format('j'); // day of month (1-31)
        });

    // Count unique IPs per day
    foreach ($visits as $day => $records) {
        $uniqueIps = $records->pluck('user_ip')->unique();
        $uniqueVisitorsPerDay[$day] = $uniqueIps->count();
    }

    $visits = collect($uniqueVisitorsPerDay);

    return view('dashboard.index', [
        'month' => $visits->keys(),     // day numbers
        'visits' => $visits->values(),   // unique user IP counts
        'currentMonth' => Carbon::now()->format('F'), // current month name
    ]);
}







public function index()
{
    // === 1. Unique Daily Visits This Month ===
    $now = Carbon::now();
    $currentMonth = $now->month;
    $currentYear = $now->year;
    $daysInMonth = $now->daysInMonth;

    $uniqueVisitorsPerDay = array_fill(1, $daysInMonth, 0); // init with 0s

    $visits = PageVisit::selectRaw('DATE(created_at) as date, user_ip')
        ->whereMonth('created_at', $currentMonth)
        ->whereYear('created_at', $currentYear)
        ->get()
        ->groupBy(fn($v) => Carbon::parse($v->date)->format('j'));

    foreach ($visits as $day => $records) {
        $uniqueIps = $records->pluck('user_ip')->unique();
        $uniqueVisitorsPerDay[(int)$day] = $uniqueIps->count();
    }

    $dailyVisits = collect($uniqueVisitorsPerDay);

    // === 2. Page Visit Counts (cleaned URLs) ===
    // $pageData = PageVisit::selectRaw('page_url, COUNT(*) as count')
    // ->groupBy('page_url')
    // ->get()
    // ->mapWithKeys(function ($item) {
    //     $cleanedUrl = str_replace([
    //         'https://www.0800dosh.me/',
    //         'https://0800dosh.me/',
    //         'https://www.0800dosh.me',
    //         'https://0800dosh.me'
    //     ], '', $item->page_url);

    //     $label = $cleanedUrl === '' ? 'home' : $cleanedUrl;

    //     return [$label => $item->count];
    // });
    $allowed = [
    'home',
    'about',
    'productservices',
    'contact',
    'serviceproviders',
    'register',
    'insurance',
    'about',
    'errorpage',
    'popup',
    'terms',
    'login',
    // 'about-us.php',
    // …add any others you want shown individually
];

// 2) Pull your raw counts, clean off the domain, and turn each visit into a “label”
$visits = PageVisit::selectRaw('page_url, COUNT(*) as count')
    ->groupBy('page_url')
    ->get()
    ->map(function($item) use ($allowed) {
        // strip off your domain variants
        $cleaned = str_replace([
            'https://www.0800dosh.me/',
            'https://0800dosh.me/',
            'https://www.0800dosh.me',
            'https://0800dosh.me',
        ], '', $item->page_url);

        // grab the first path segment (or empty ⇒ home)
        $seg = explode('/', ltrim($cleaned, '/'))[0] ?? '';
        $label = $seg === '' ? 'home' : $seg;

        // if it’s not in our whitelist, call it “unknown”
        if ( ! in_array($label, $allowed) ) {
            $label = 'unknown';
        }

        return [
            'label' => $label,
            'count' => $item->count,
        ];
    });

// 3) Now regroup by label and sum up the counts
$pageData = $visits
    ->groupBy('label')
    ->map(function($group) {
        return $group->sum('count');
    });




    // === 3. Get user devices===
    $userAgents = PageVisit::pluck('user_agent');
    $deviceCounts = [];

    foreach ($userAgents as $ua) {
        $agent = new Agent();
        $agent->setUserAgent($ua);

        $device = $agent->device() ?: 'Unknown';

        if (isset($deviceCounts[$device])) {
            $deviceCounts[$device]++;
        } else {
            $deviceCounts[$device] = 1;
        }
    }

    // === 4. User Activity===
    $logs = UserActivity::with('user')->latest()->take(10)->get();

    $logs->transform(function ($log) {
    $agent = new Agent();
    $agent->setUserAgent($log->user_agent);

    $log->device = $agent->device() ?: 'Unknown';

    return $log;
    });

    // === Return to View ===
    return view('dashboard.index', [
        'month' => $dailyVisits->keys(),
        'visits' => $dailyVisits->values(),
        'currentMonth' => $now->format('F'),
        'pageData' => $pageData,
        'pages' => $pageData->keys(),
        'page_visits' => $pageData->values(),
        'deviceNames' => collect($deviceCounts)->keys(),
        'deviceCounts' => collect($deviceCounts)->values(),
        'userActivity' => $logs,
    ]);
}



}
