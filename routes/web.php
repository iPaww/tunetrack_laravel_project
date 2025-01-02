<?php

use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ElearningController;
use App\Http\Controllers\ExcerciseController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ELearningCourseController;
use App\Http\Controllers\AdminControllers\QuizController;
use App\Http\Controllers\AdminControllers\UserController;
use App\Http\Controllers\AdminControllers\AdminController;
use App\Http\Controllers\AdminControllers\SalesController;
use App\Http\Controllers\AdminControllers\CourseController;
use App\Http\Controllers\AdminControllers\TopicsController;
use App\Http\Controllers\AdminControllers\InventoryController;
use App\Http\Controllers\AdminControllers\ItemTrackController;
use App\Http\Controllers\AdminControllers\InstrumentsController;
use App\Http\Controllers\AdminControllers\MainCategoryController;
use App\Http\Middleware\AdminMiddleware\Authenticate as AdminAuthenticate;
use App\Http\Controllers\AdminControllers\LoginController as AdminLoginController;

use App\Http\Controllers\AdminControllers\ProfileController as AdminProfileController;
use App\Http\Controllers\AdminControllers\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\AdminControllers\CourseController as AdminControllersCourseController;


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
    return view('basic_page', [ 'page' => 'index' ]);
});

Route::controller(AppointmentController::class)
    ->middleware(Authenticate::class)
    ->group(function () {
        Route::get('/appointment', 'index');
    });

Route::controller(AboutUsController::class)->group(function () {
    Route::get('/about-us', 'index');
});

Route::controller(ElearningController::class)
    ->prefix('elearning')
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/category/{id}', 'category');
        Route::controller(ELearningCourseController::class)
            ->prefix('/category/{id}/course/{course_id}')
            ->group(function () {
                Route::get('/', 'index');
                Route::get('/topic/{topic_id}', 'topic');
                Route::get('/quiz', 'quiz');
                Route::get('/quiz/{quiz_id}', 'quiz_question')->middleware(Authenticate::class);
                Route::post('/quiz/{quiz_id}', 'quiz_submit')->middleware(Authenticate::class);
                Route::get('/overall', 'overall')->middleware(Authenticate::class);
                Route::post('/overall', 'retake')->middleware(Authenticate::class);
            });
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
        Route::get('/product/{id}/view', 'view_product')->withoutMiddleware([Authenticate::class]);
        Route::get('/orders', 'orders');
        Route::get('/order/{id}/view', 'order_view');
        Route::get('/cart', 'cart');
        Route::post('/cart/add/{id}', 'cart_add');
        Route::post('/cart/edit/{id}', 'cart_edit');
        Route::post('/cart/remove/{id}', 'cart_remove');
    });

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index');
    Route::post('/login', 'login');
    Route::get('/logout', 'logout');
    Route::get('/register', 'register');
    Route::post('/register', 'register_form');
});

Route::prefix('admin')->group(function() {
    Route::controller(AdminLoginController::class)
    ->middleware(AdminAuthenticate::class)
    ->group(function () {
        // Route::get('/login', 'login')->withoutMiddleware([AdminAuthenticate::class]);
        // Route::post('/login', 'login_form')->withoutMiddleware([AdminAuthenticate::class]);
        // Route::get('/register', 'register')->withoutMiddleware([AdminAuthenticate::class]);
        Route::get('/logout', 'logout');

        Route::controller(AdminController::class)
            ->group(function () {
                Route::get('/', 'index');
            });

        Route::controller(AdminAppointmentController::class)
            ->prefix('appointment')
            ->group(function () {
                Route::get('/', 'index');
            });

        Route::controller(InstrumentsController::class)
            ->prefix('instruments')
            ->group(function () {
                Route::get('/', 'index');
                Route::get('instrument/add', 'add');
                Route::get('category/add', 'category_add');
                Route::get('type/add', 'type_add');
                Route::get('supplies/add', 'supplies_add');
            });

        Route::controller(InventoryController::class)
            ->prefix('inventory')
            ->group(function () {
                Route::get('/', 'index');
            });

        Route::controller(ItemTrackController::class)
            ->prefix('item-track')
            ->group(function () {
                Route::get('/', 'index');
            });

        Route::controller(AdminProfileController::class)
            ->prefix('profile')
            ->group(function () {
                Route::get('/', 'index');
            });

        Route::controller(QuizController::class)
            ->prefix('quiz')
            ->group(function () {
                Route::get('/', 'index');
            });

        Route::controller(MainCategoryController::class)
            ->prefix('main-category')
            ->group(function () {
                Route::get('/', 'index');
                Route::get('/add', 'addMain');
                Route::post('/add', 'add');
                Route::get('/edit/{id}', 'editMain');
                Route::post('/edit/{id}', 'edit');
            });

        Route::controller(MainCategoryController::class)
            ->prefix('sub-category')
            ->group(function () {
                Route::get('/', 'index');
            });

        Route::controller(CourseController::class)
            ->prefix('courses')
            ->group(function () {
                Route::get('/', 'index');
            });

        Route::controller(TopicsController::class)
            ->prefix('topics')
            ->group(function () {
                Route::get('/', 'index');
            });

        Route::controller(SalesController::class)
            ->middleware(AdminAuthenticate::class) // TODO FIXME: Middleware for superadmin
            ->prefix('sales')
            ->group(function () {
                Route::get('/', 'index');
            });

        Route::controller(UserController::class)
            ->middleware(AdminAuthenticate::class) // TODO FIXME: Middleware for superadmin
            ->prefix('users')
            ->group(function () {
                Route::get('/', 'index');
            });

    });
});
