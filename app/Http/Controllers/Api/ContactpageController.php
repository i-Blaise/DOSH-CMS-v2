<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactPage;
use Illuminate\Http\Request;

class ContactpageController extends Controller
{
    public function contactPage() {
        $contact_page = ContactPage::select('header_image', 'header_caption', 'section_image')->first();
        return response()->json($contact_page);
    }
}
