<?php

use App\Http\Controllers\AboutUs\AboutUsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Homepage\HomeSectionsController;
use App\Http\Controllers\Homepage\SlideshowController;
use App\Http\Controllers\PnS\PnSController;
use App\Http\Controllers\PnS\PnSHeaderController;
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
        'home-sections' => HomeSectionsController::class,
        'aboutus-sections' => AboutUsController::class
    ]);

    Route::post('publish-slider/{id}', [SlideshowController::class, 'publish'])->name('publish-slider');

    // Products and Services
    Route::get('pns-header/{status?}', [PnSController::class, 'index'])->name('pns-header');

    Route::post('submit-pns-header', [PnSController::class, 'storePnSHeader'])->name('submit-pns-header');

    Route::get('pns-sections/{name?}', [PnSController::class, 'edit'])->name('pns-section');

    // Route::post('submit-pns-header', [PnSHeaderController::class, 'previewToHeaderPnS'])->name('submit-pns-header');

    // Route::get('/about-us', function () {
    //     return view('dashboard.pages.aboutus.index');
    // })->name('about-us');

    Route::get('preview', function () {
        return view('dashboard.pages.preview.index');
    })->name('preview');

    // Route::get('pns-section', function () {
    //     return view('dashboard.pages.pns.pns-sections');
    // })->name('pns-section');

});
