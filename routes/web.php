<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ElearningController;
use App\Http\Controllers\ExcerciseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;

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

Route::get('/', function () {
    return view('basic_page', [ 'page' => 'index', 'fullname' => 'Guest' ]);
});



Route::controller(AppointmentController::class)->group(function () {
    Route::get('/appointment', 'index');
});

Route::controller(ContactController::class)->group(function () {
    Route::get('/contact', 'index');
});

Route::controller(ElearningController::class)->group(function () {
    Route::get('/elearning/string', 'string');
    Route::get('/elearning/string/{instrument}', 'string_instrument');

    Route::get('/elearning/percussion', 'percussion');
    Route::get('/elearning/percussion/{instrument}', 'percussion_instrument');

    Route::get('/elearning/aerophones', 'aerophones');
    Route::get('/elearning/aerophones/{instrument}', 'aerophones_instrument');

    Route::get('/elearning/idiophones', 'idiophones');
    Route::get('/elearning/idiophones/{instrument}', 'idiophones_instrument');

    Route::get('/elearning/brass', 'brass');
    Route::get('/elearning/brass/{instrument}', 'brass_instrument');

    Route::get('/elearning/electrophones', 'electrophones');
    Route::get('/elearning/electrophones/{instrument}', 'electrophones_instrument');
});

Route::controller(ExcerciseController::class)->group(function () {
    Route::get('/excercise', 'index');
});

Route::controller(ProfileController::class)->group(function () {
    Route::get('/profile', 'index');
});

Route::controller(ShopController::class)->group(function () {
    Route::get('/shop', 'index');
    Route::get('/shop/product/{category}/view/{id}', 'view_product');
    Route::get('/shop/orders', 'orders');
    Route::get('/shop/cart', 'cart');
});
