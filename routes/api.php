<?php

use App\Http\Controllers\Api\AboutUsController;
use App\Http\Controllers\Api\HomepageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/show-slideshow', [HomepageController::class, 'showSlideShowData']);
Route::get('/show-home-sections', [HomepageController::class, 'showHomepageSesctions']);


// About Us Page
Route::get('/fetch-about-data', [AboutUsController::class, 'fetchAboutUsData']);
