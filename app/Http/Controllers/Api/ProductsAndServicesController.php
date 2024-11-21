<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PnSHeader;
use App\Models\PnSPage;
use Illuminate\Http\Request;

class ProductsAndServicesController extends Controller
{
    public function fetchProductsAndServicesData()
    {
        $pnsPage = PnSPage::select('*')
            ->get()
            ->makeHidden(['created_at', 'updated_at']);

        $pnsHeader = PnSHeader::select('*')
            ->get()
            ->makeHidden(['created_at', 'updated_at']);

        $data = [
            'page' => $pnsPage,
            'header' => $pnsHeader
        ];

        return response()->json($data);
    }
}
