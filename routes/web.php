<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Authentication Routes
Auth::routes();
Route::post('/postLogin', 'Auth\LoginController@postLogin')->name('postlogin');
Route::get('activate', 'AuthController@verifyAccount');

// Routes for Front
Route::get('/', 'HomeController@index')->name('home');

Route::get('/booking-stadium', 'Front\BookingStadiumController@show');
Route::post('/booking-stadium/book', 'Front\BookingStadiumController@book');
Route::post('/booking-stadium/booked', 'Front\BookingStadiumController@saveBooking');


Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

// Routes for Dashboard
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    Route::get('/', 'Dashboard\HomeController@index');

});

// Routes for Admin
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/', 'Admin\HomeController@index');

    // User Routes
    Route::resource('user', 'Admin\UserController');
    Route::get('user/{id}/profile', 'Admin\UserController@profile');
    Route::put('user/{id}/profile', 'Admin\UserController@update_profile');
    Route::get('user/{id}/setting', 'Admin\UserController@setting');
    Route::put('user/{id}/setting', 'Admin\UserController@update_setting');

    // Cropper Model
    Route::get('cropper/{element}', [\App\Http\Controllers\Admin\ImageController::class, 'cropper'])->name('cropper');

    Route::post('image/upload', [\App\Http\Controllers\Admin\ImageController::class, 'store'])->name('image.store');

    // Get quill image uploaded
    Route::get('quill-image/{image}', [\App\Http\Controllers\Admin\ImageController::class, 'getImage'])->name('image.getImage');

    //Booking routes
    Route::resource('bookings', 'Admin\BookingController');
});