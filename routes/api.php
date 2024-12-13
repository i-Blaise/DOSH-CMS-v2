<?php

use App\Http\Controllers\Api\AboutUsController;
use App\Http\Controllers\Api\ContactpageController;
use App\Http\Controllers\Api\HomepageController;
use App\Http\Controllers\Api\MiscController;
use App\Http\Controllers\Api\ProductsAndServicesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/show-slideshow', [HomepageController::class, 'showSlideShowData']);
Route::get('/show-home-sections', [HomepageController::class, 'showHomepageSesctions']);


// About Us Page
Route::get('/fetch-about-data', [AboutUsController::class, 'fetchAboutUsData']);

// Products and Services
Route::get('/fetch-pns-data', [ProductsAndServicesController::class, 'fetchProductsAndServicesData']);

// Contact Page
Route::get('/fetch-contact-data', [ContactpageController::class, 'contactPage']);


// Privacy Statement
Route::get('/privacy-statement', [MiscController::class, 'getPrivacyStatement']);
