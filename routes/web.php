<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserProfileController;

// Route::get('/', function () {
//     return view('dashboard/pages/auth/login');
// });


Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('custom-login', [AuthController::class, 'customLogin'])->name('login.custom');
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/admin', function () {
    return view('dashboard.index');
    })->name('admin');

    Route::resource('/profile', UserProfileController::class);
});
