<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Homepage\HomeSectionsController;
use App\Http\Controllers\Homepage\SlideshowController;
use App\Http\Controllers\UserProfileController;




Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('custom-login', [AuthController::class, 'customLogin'])->name('login.custom');
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('dashboard.index');
    });
    Route::get('/admin', function () {
        return view('dashboard.index');
    })->name('admin');

    // Route::resource('/profile', UserProfileController::class);
    // Route::resource('slideshow', SlideshowController::class);

    Route::resources([
        'profile' => UserProfileController::class,
        'slideshow' => SlideshowController::class,
        'home-sections' => HomeSectionsController::class
    ]);
});
