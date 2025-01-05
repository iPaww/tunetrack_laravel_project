<?php

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\Verification;
use App\Http\Middleware\CourseProgressTracker;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers;
use App\Http\Controllers\BasePageController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\VerificationForm;
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
use App\Http\Controllers\AdminControllers\BrandsController;
use App\Http\Controllers\AdminControllers\ColorsController;
use App\Http\Controllers\AdminControllers\TopicsController;
use App\Http\Controllers\AdminControllers\InventoryController;
use App\Http\Controllers\AdminControllers\ItemTrackController;
use App\Http\Controllers\AdminControllers\InstrumentsController;
use App\Http\Controllers\AdminControllers\ProductTypeController;
use App\Http\Controllers\AdminControllers\SubCategoryController;
use App\Http\Controllers\AdminControllers\MainCategoryController;
use App\Http\Middleware\AdminMiddleware\Authenticate as AdminAuthenticate;
use App\Http\Controllers\AdminControllers\LoginController as AdminLoginController;
use App\Http\Controllers\AdminControllers\CourseController as AdminCourseController;
use App\Http\Controllers\AdminControllers\ProfileController as AdminProfileController;
use App\Http\Controllers\AdminControllers\AppointmentController as AdminAppointmentController;

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
    $basepage = new BasePageController();
    return $basepage->view_basic_page('index');
});

Route::controller(AppointmentController::class)
    ->middleware([Authenticate::class, Verification::class])
    ->group(function () {
        Route::get('/appointment', 'index');
    });

Route::controller(AboutUsController::class)->group(function () {
    Route::get('/about-us', 'index');
});

Route::controller(ElearningController::class)
    ->prefix('elearning')
    ->middleware([CourseProgressTracker::class])
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/category/{id}', 'category');
        Route::controller(ELearningCourseController::class)
            ->prefix('/category/{id}/course/{course_id}')
            ->group(function () {
                Route::get('/', 'index');
                Route::get('/topic/{topic_id}', 'topic');
                Route::get('/quiz', 'quiz');
                Route::get('/quiz/{quiz_id}', 'quiz_question')->middleware([Authenticate::class, Verification::class]);
                Route::post('/quiz/{quiz_id}', 'quiz_submit')->middleware([Authenticate::class, Verification::class]);
                Route::get('/overall', 'overall')->middleware([Authenticate::class, Verification::class]);
                Route::post('/overall', 'retake')->middleware([Authenticate::class, Verification::class]);
            });
    });

Route::controller(ExcerciseController::class)->group(function () {
    Route::get('/excercise', 'index');
});

Route::controller(ProfileController::class)
    ->middleware([Authenticate::class])
    ->prefix('profile')
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/learning', 'learning');
        Route::get('/exam', 'exam');
        Route::get('/certificate', 'certificate');
        Route::get('/orders', 'orders');
    });

Route::controller(ShopController::class)
    ->middleware([Authenticate::class, Verification::class])
    ->middleware(Verification::class)
    ->prefix('shop')
    ->group(function () {
        Route::get('/', 'index')->withoutMiddleware([Authenticate::class, Verification::class]);
        Route::get('/product/{id}/view', 'view_product')->withoutMiddleware([Authenticate::class, Verification::class]);
        Route::get('/orders', 'orders');
        Route::get('/order/{id}/view', 'order_view');
        Route::get('/cart', 'cart');
        Route::post('/cart/add/{id}', 'cart_add');
        Route::post('/cart/edit/{id}', 'cart_edit');
        Route::post('/cart/remove/{id}', 'cart_remove');
        Route::post('/cart/check_out', 'cart_checkout');
    });

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index');
    Route::post('/login', 'login');
    Route::get('/logout', 'logout');
    Route::get('/register', 'register');
    Route::post('/register', 'register_form');
    Route::get('/verification', 'verification')->middleware(Authenticate::class)->middleware(VerificationForm::class);
    Route::post('/verification', 'verification_form')->middleware(Authenticate::class)->middleware(VerificationForm::class);
    Route::get('/verification/re-send', 'verification_resend')->middleware(Authenticate::class)->middleware(VerificationForm::class);
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

            Route::prefix('appointment')->controller(AdminAppointmentController::class)->group(function () {
                Route::get('/', 'index')->name('admin.appointment.index');
                Route::put('update/{id}', 'update')->name('admin.appointment.update');
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

        Route::controller(ColorsController::class)
            ->prefix('colors')
            ->group(function () {
                Route::get('/', 'index')->name('colors.index');
                Route::get('create', 'create')->name('colors.create');
                Route::post('store', 'store')->name('colors.store');
                Route::get('edit/{id}', 'edit')->name('colors.edit');
                Route::put('update/{id}', 'update')->name('colors.update');
                Route::delete('destroy/{id}', 'destroy')->name('colors.destroy');
            });

        Route::controller(BrandsController::class)
        ->prefix('brands')
        ->group(function () {
            Route::get('/', 'index')->name('brands.index');
            Route::get('create', 'create')->name('brands.create');
            Route::post('store', 'store')->name('brands.store');
            Route::get('edit/{id}', 'edit')->name('brands.edit');
            Route::put('update/{id}', 'update')->name('brands.update');
            Route::delete('brands/destroy/{id}', 'destroy')->name('brands.destroy');

        });

        Route::controller(ProductTypeController::class)
            ->prefix('product_type')
            ->group(function () {
                Route::get('/', 'index')->name('product_type.index');
                Route::get('/create', 'create')->name('product_type.create');
                Route::post('/', 'store')->name('product_type.store');
                Route::get('/{id}/edit', 'edit')->name('product_type.edit');
                Route::put('/{id}', 'update')->name('product_type.update');
                Route::delete('/product_type/{id}', 'destroy')->name('product_type.destroy');
        });

        Route::controller(InventoryController::class)
            ->prefix('inventory')
            ->group(function () {
                Route::get('/', 'index');
            });

            Route::controller(ItemTrackController::class)
                ->prefix('item-track')
                ->group(function () {
                    Route::get('/', 'index')->name('itemTrack.index');   // For displaying the orders
                    Route::post('/', 'index')->name('itemTrack.index');  // For handling the status update
                });

        Route::controller(AdminProfileController::class)
            ->prefix('profile')
            ->group(function () {
                Route::get('/', 'index');
            });

            Route::controller(QuizController::class)
            ->prefix('quiz')
            ->as('quiz.')  // This applies to all routes inside this group
            ->group(function () {
                Route::get('/', 'index')->name('index');  // quiz.index
                Route::get('/add', 'addQuiz')->name('add');  // quiz.add
                Route::post('/add', 'add')->name('store');  // quiz.store
                Route::get('/edit/{id}', 'edit')->name('edit');  // quiz.edit
                Route::put('/update/{id}', 'update')->name('update');  // quiz.update
                Route::delete('/delete/{id}', 'destroy')->name('destroy');  // quiz.destroy
            });

        Route::controller(MainCategoryController::class)
            ->prefix('main-category')
            ->group(function () {
                Route::get('/', 'index');
                Route::get('/add', 'addMain');
                Route::post('/add', 'add');
                Route::get('/edit/{id}', 'editMain');
                Route::post('/edit/{id}', 'edit');
                Route::delete('/{id}','destroy');
            });

            Route::controller(SubCategoryController::class)
            ->prefix('sub-category')
            ->group(function () {
                Route::get('/', 'index');
                Route::get('/add', 'addSub');
                Route::post('/add', 'add');
                Route::get('/edit/{id}', 'editSub');
                Route::post('/edit/{id}', 'edit');
                Route::delete('/{id}', 'destroy');  // Correct DELETE route
            });

        Route::prefix('courses')->controller(AdminCourseController::class)->group(function () {
                Route::get('/', 'index')->name('courses.index'); // View all courses
                Route::get('/create', 'create')->name('courses.create'); // Show create form
                Route::post('/', 'store')->name('courses.store'); // Store a new course
                Route::get('/{course}/edit', 'edit')->name('courses.edit');
                Route::put('/{course}', 'update')->name('courses.update');
                Route::delete('/{course}', 'destroy')->name('courses.destroy');
            });

        Route::prefix('topics')->name('topics.')->controller(TopicsController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
                Route::get('edit/{topic}', 'edit')->name('edit');
                Route::put('update/{topic}', 'update')->name('update');
                Route::delete('destroy/{topic}', 'destroy')->name('destroy');
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

Route::prefix('/mailable')
    ->middleware(AdminAuthenticate::class)
    ->group(function () {
        Route::get('/account_verification', function () {
            $user = App\Models\User::find(3);
            return new App\Mail\UserVerification($user->id);
        });
    });
