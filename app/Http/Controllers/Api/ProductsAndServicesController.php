<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DoshInsurance;
use App\Models\HomeSections;
use App\Models\InsuranceReadMoreModal;
use App\Models\PnSHeader;
use App\Models\PnSPage;
use App\Models\PnSVideoSec;
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


    public function fetchInsurancePackages() {
        $dosh365 = DoshInsurance::select('id', 'image', 'desc')
            ->whereIn('id', [1, 2, 3, 4, 5, 6])
            ->get()
            ->map(function($item) {
                return [
                    'id' => $item->id,
                    'image' => $item->image,
                    'details' => $item->desc
                ];
            });

        return response()->json($dosh365);
    }

        public function fetchInsurancePackagesEnhanced() {
        $dosh365 = DoshInsurance::select('image', 'desc')
            ->whereIn('id', [12, 13, 14, 15, 16, 17])
            ->get()
            ->map(function($item, $index) {
                return [
                    'id' => $index + 1,
                    'image' => $item->image,
                    'details' => $item->desc
                ];
            });

        return response()->json($dosh365);
    }


    public function fetchFinancialPersonal() {
        $dosh365 = DoshInsurance::select('image', 'desc')
            ->whereIn('id', [7, 8])
            ->get()
            ->map(function($item, $index) {
                return [
                    'id' => $index + 1,
                    'image' => $item->image,
                    'details' => $item->desc
                ];
            });

        return response()->json($dosh365);
    }


    public function fetchFinancialBusiness() {
        $dosh365 = DoshInsurance::select('image', 'desc')
            ->whereIn('id', [9, 10, 11])
            ->get()
            ->map(function($item, $index) {
                return [
                    'id' => $index + 1,
                    'image' => $item->image,
                    'details' => $item->desc
                ];
            });

        return response()->json($dosh365);
    }


    public function sliderInsuraceData() {
        $insuraceSec = DoshInsurance::select('id', 'home_caption', 'home_body', 'home_image')
            ->whereIn('id', [1, 7, 18])
            ->get();

        $sectionKeys = [
            1 => 'financial_slide',
            7 => 'health_slide',
            18 => 'risk_slide'
        ];

        $formattedData = [];

        foreach ($insuraceSec as $section) {
            $key = $sectionKeys[$section->id] ?? 'section_' . $section->id;

            $formattedData[$key] = [
                'section_caption' => $section->home_caption,
                'section_body' => $section->home_body,
                'section_image' => $section->home_image
            ];
        }

        return response()->json($formattedData);
    }




    public function HealthInsuranceModal()
    {
        $insuranceReadMore = InsuranceReadMoreModal::where('insurance_name', 'insurance')->select('image', 'description', 'references')
            ->get();

        $insuranceReadMore = $insuranceReadMore->map(function($insurance) {
            return [
            'image' => $insurance->image,
            'description' => $insurance->description,
            'references' => $insurance->references,
            'insurance_name' => 'health insurance'
            ];
        });

        return response()->json($insuranceReadMore);

    }

    public function FinancialInsuranceModal()
    {
        $insuranceReadMore = InsuranceReadMoreModal::where('insurance_name', 'financial')->select('image', 'description', 'references')
            ->get();

        $insuranceReadMore = $insuranceReadMore->map(function($insurance) {
            return [
            'image' => $insurance->image,
            'description' => $insurance->description,
            'references' => $insurance->references,
            'insurance_name' => 'financial insurance'
            ];
        });

        return response()->json($insuranceReadMore);
    }

    public function RiskInsuranceModal()
    {
        $insuranceReadMore = InsuranceReadMoreModal::where('insurance_name', 'risk')->select('image', 'description', 'references', 'insurance_name')
            ->get();

        return response()->json($insuranceReadMore);
    }

    public function fetchVideoSection()
    {
        $video_section = PnSVideoSec::select('video_title', 'video_url', 'video_subtitle', 'video_description')
            ->first()
            ->makeHidden(['created_at', 'updated_at']);

        return response()->json($video_section);
    }
}
