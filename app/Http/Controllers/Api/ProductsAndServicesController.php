<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DoshInsurance;
use App\Models\HomeSections;
use App\Models\InsuranceReadMoreModal;
use App\Models\PnSHeader;
use App\Models\PnSPage;
use Illuminate\Http\Request;

class ProductsAndServicesController extends Controller
{
    public function fetchProductsAndServicesData()
    {
        $insuraceSec = DoshInsurance::select('home_caption', 'home_body', 'home_image')
            ->whereIn('id', [1, 7, 18])
            ->get();

        $insuraceSec = $insuraceSec->map(function($section) {
            return [
                'section_caption' => $section->home_caption,
                'section_body' => $section->home_body,
                'section_image' => $section->home_image
            ];
        });

        $insuranceReadMore = InsuranceReadMoreModal::select('image', 'description', 'references', 'insurance_name')
            ->get();

        $pnsHeader = PnSHeader::select('*')
            ->get()
            ->makeHidden(['created_at', 'updated_at']);


        $health_insurance = DoshInsurance::select('insurance_name', 'image', 'desc')
            ->where('insurance_type', 'insurance')
            ->get();

        $health_insurance = $health_insurance->map(function($insurance) {
            return [
                'insurance_name' => $insurance->insurance_name,
                'image' => $insurance->image,
                'desc' => $insurance->desc
            ];
        });

        $financial_insurance = DoshInsurance::select('insurance_name', 'image', 'desc')
            ->where('insurance_type', 'financial')
            ->get();

        $financial_insurance = $financial_insurance->map(function($insurance) {
            return [
                'insurance_name' => $insurance->insurance_name,
                'image' => $insurance->image,
                'desc' => $insurance->desc,
            ];
        });

        // $risk_insurance = HomeSections::first()->risk_modal_body;

        $data = [
            'header' => $pnsHeader,
            'insurance_section' => $insuraceSec,
            'insurance_readmore_modal' => $insuranceReadMore,
            'health_insurance' => $health_insurance,
            'financial_insurance' => $financial_insurance,
            // 'risk_insurance' => $risk_insurance
        ];

        return response()->json($data);
    }

    public function fetchPnSModalData()
    {
        $insuranceReadMore = InsuranceReadMoreModal::select('image', 'description', 'references', 'insurance_name')
            ->get();
        // dd('okay');

        return response()->json($insuranceReadMore);

    }
}
