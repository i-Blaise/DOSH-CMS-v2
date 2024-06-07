<?php

use App\Http\Controllers\Api\HomepageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/show-slideshow', [HomepageController::class, 'showSlideShowData']);
Route::get('/show-home-sections', [HomepageController::class, 'showHomepageSesctions']);
