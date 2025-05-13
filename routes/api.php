<?php

use App\Http\Controllers\Api\AboutUsController;
use App\Http\Controllers\Api\ContactpageController;
use App\Http\Controllers\Api\HomepageController;
use App\Http\Controllers\Api\MiscController;
use App\Http\Controllers\Api\PageVisitController;
use App\Http\Controllers\Api\ProductsAndServicesController;
use App\Http\Controllers\Api\ServiceProvidersController;
use Illuminate\Support\Facades\Route;

Route::get('/show-slideshow', [HomepageController::class, 'showSlideShowData']);
Route::get('/show-home-sections', [HomepageController::class, 'showHomepageSesctions']);


// About Us Page
Route::get('/fetch-about-data', [AboutUsController::class, 'fetchAboutUsData']);

// Products and Services
Route::get('/fetch-pns-data', [ProductsAndServicesController::class, 'fetchProductsAndServicesData']);

// PnS Modal Routes
Route::get('/health-insurance-modal', [ProductsAndServicesController::class,'HealthInsuranceModal']);

Route::get('/financial-insurance-modal', [ProductsAndServicesController::class,'FinancialInsuranceModal']);

Route::get('/risk-insurance-modal', [ProductsAndServicesController::class,'RiskInsuranceModal']);


// PnS Video Section
Route::get('/fetch-pns-video-sec', [ProductsAndServicesController::class, 'fetchVideoSection']);

// PnS Slider Section
Route::get('/fetch-pns-slider-sec', [ProductsAndServicesController::class, 'sliderInsuraceData']);

// Service Providers Header
Route::get('/fetch-hsp-header', [ServiceProvidersController::class, 'fetchHSPHeader']);

Route::get('/fetch-hsp-page-titles', [ServiceProvidersController::class, 'fetchHSPPageTitles']);

// Contact Page
Route::get('/fetch-contact-data', [ContactpageController::class, 'contactPage']);


// Privacy Statement
Route::get('/privacy-statement', [MiscController::class, 'getPrivacyStatement']);


// Page Visit Tracking
// Route::post('/page-visit', [PageVisitController::class, 'store']);
Route::middleware(['throttle:60,1'])->post('/page-visit', [PageVisitController::class, 'store']);
