<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PageVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PageVisitController extends Controller
{
    // public function store(Request $request)
    // {

    //     $referer = $request->headers->get('referer');

    //     if (!str_contains($referer, 'your-frontend-domain.com')) {
    //         return response()->json(['error' => 'Unauthorized access'], 403);
    //     }

    //     PageVisit::create([
    //         'page_url' => $request->input('page_url'),
    //         'referer' => $request->header('referer'),
    //         'user_ip' => $request->ip(),
    //         'user_agent' => $request->header('User-Agent'),
    //     ]);

    //     return response()->json(['message' => 'Visit recorded'], 201);
    // }


        public function store(Request $request)
        {
            $origin = $request->headers->get('origin');
            $referer = $request->headers->get('referer');
            $userIp = $request->ip();
            $userAgent = $request->header('User-Agent');

            // Log the origin and other request details
            Log::info('Page visit attempt', [
                'origin' => $origin,
                'referer' => $referer,
                'ip' => $userIp,
                'user_agent' => $userAgent,
            ]);

            // Optional: Reject if referer doesn't match
            if (!str_contains($referer, 'https://www.0800dosh.me/')) {
                Log::warning('Unauthorized page visit attempt blocked', [
                    'referer' => $referer,
                    'ip' => $userIp,
                ]);
                return response()->json(['error' => 'Unauthorized access'], 403);
            }

            // Store visit
            PageVisit::create([
                'page_url' => $request->input('page_url'),
                'referer' => $referer,
                'user_ip' => $userIp,
                'user_agent' => $userAgent,
            ]);

            return response()->json(['message' => 'Visit recorded'], 201);
        }

}
