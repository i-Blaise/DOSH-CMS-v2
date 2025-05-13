<?php

use App\Models\UserActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

if (!function_exists('logActivity')) {
    function logActivity($activity)
    {
        UserActivity::create([
            'user_id'    => Auth::id(),
            'activity'   => $activity,
            'ip_address' => Request::ip(),
            'user_agent' => Request::header('User-Agent'),
        ]);
    }
}
