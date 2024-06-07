<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HomeSections;
use App\Models\Slideshow;
use Illuminate\Http\Request;

class HomepageController extends Controller
{

    public function showSlideShowData()
    {
        $slideshow = Slideshow::select('slideshow_image', 'caption', 'body')->get();
        // foreach($slideshows as $slideshow){
        //    $slideshow['slideshow_image'] = 'https://doshcms.interactivedigital.com.gh/'.$slideshow['slideshow_image'];
        // }
        return response()->json($slideshow);
    }

    public function showHomepageSesctions(){
        $home_sections = HomeSections::select(
        'insurance_image',
        'insurance_caption',
        'insurance_body',
        'finance_caption',
        'finance_body',
        'ride_image',
        'ride_caption',
        'ride_body',
        'erp_image',
        'erp_caption',
        'erp_body',
        'commerce_image',
        'commerce_caption',
        'commerce_body')->get();
        return response()->json($home_sections);
    }
}
