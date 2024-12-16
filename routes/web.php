<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ElearningController;
use App\Http\Controllers\ExcerciseController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;

use App\Http\Middleware\Authenticate;


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

Route::controller(AppointmentController::class)
    ->middleware(Authenticate::class)
    ->group(function () {
        Route::get('/appointment', 'index');
    });

Route::controller(ContactController::class)->group(function () {
    Route::get('/contact', 'index');
});

Route::controller(ElearningController::class)
    ->prefix('elearning')
    ->group(function () {
        Route::get('/string', 'string');
        Route::get('/string/{instrument}', 'string_instrument');

        Route::get('/percussion', 'percussion');
        Route::get('/percussion/{instrument}', 'percussion_instrument');

        Route::get('/aerophones', 'aerophones');
        Route::get('/aerophones/{instrument}', 'aerophones_instrument');

        Route::get('/idiophones', 'idiophones');
        Route::get('/idiophones/{instrument}', 'idiophones_instrument');

        Route::get('/brass', 'brass');
        Route::get('/brass/{instrument}', 'brass_instrument');

        Route::get('/electrophones', 'electrophones');
        Route::get('/electrophones/{instrument}', 'electrophones_instrument');
    });

Route::controller(ExcerciseController::class)->group(function () {
    Route::get('/excercise', 'index');
});

Route::controller(ProfileController::class)
    ->middleware(Authenticate::class)
    ->prefix('profile')
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/learning', 'learning');
        Route::get('/exam', 'exam');
        Route::get('/certificate', 'certificate');
        Route::get('/orders', 'orders');
    });

Route::controller(ShopController::class)
    ->middleware(Authenticate::class)
    ->prefix('shop')
    ->group(function () {
        Route::get('/', 'index')->withoutMiddleware([Authenticate::class]);
        Route::get('/product/{category}/view/{id}', 'view_product')->withoutMiddleware([Authenticate::class]);
        Route::get('/orders', 'orders');
        Route::get('/cart', 'cart');
    });

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index');
    Route::post('/login', 'login');
    Route::get('/logout', 'logout');
    Route::get('/register', 'register');
    Route::post('/register', 'register_form');
});