<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceProvidersHeader;
use App\Models\ServiceProvidersTitles;

class ServiceProvidersController extends Controller
{
    public function fetchHSPHeader()
    {
        $data = ServiceProvidersHeader::all()->makeHidden(['id', 'created_at', 'updated_at']);
        return response()->json($data);
    }

    public function fetchHSPPageTitles()
    {
        $data = ServiceProvidersTitles::all()->makeHidden(['id', 'created_at', 'updated_at']);
        return response()->json($data);
    }
}
