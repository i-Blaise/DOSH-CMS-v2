<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function fetchAboutUsData()
    {
        $data = AboutUs::all();
        return response()->json($data);
    }
}
