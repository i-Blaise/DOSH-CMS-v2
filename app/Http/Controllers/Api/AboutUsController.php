<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function fetchAboutUsData()
    {
        $data = AboutUs::select('*')
            ->get()
            ->makeHidden(['created_at', 'updated_at']);
        return response()->json($data);
    }
}
