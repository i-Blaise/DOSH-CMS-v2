<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HSP;
use Illuminate\Http\Request;

class HSPController extends Controller
{
    public function getHspDataByRegion($region)
    {
        $data = HSP::where('region_name', $region)
            ->get()
            ->makeHidden(['created_at', 'updated_at']);
        return response()->json($data);
    }
}
