<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\FamilyController;
use App\Http\Controllers\Admin\FamilyRegistrationController;
use App\Http\Controllers\Admin\GoodsController;
use App\Http\Controllers\Admin\HandoverController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\PeriodController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RegistrationSupportController as AdminRegistrationSupportController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\AuthController as ClientAuthController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\RegisterController;
use App\Http\Controllers\Client\RegistrationSupportController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// ADMIN AREA
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::middleware(['guest'])->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);
    });

    Route::middleware(['auth', 'auth_admin'])->group(function () {
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/home', [AdminHomeController::class, 'index'])->name('index');


        Route::group(['as' => 'user.', 'prefix' => 'user', 'middleware' => 'acl:user.manage'], function () {
            Route::get('index', [UserController::class, 'index'])->name('index');
            // Route::get('search', [UserController::class, 'search'])->name('search');
            Route::get('create', [UserController::class, 'create'])->name('create');
            Route::post('create', [UserController::class, 'store'])->name('store');
            Route::get('edit/{id?}', [UserController::class, 'edit'])->name('edit');
            Route::put('update/{id?}', [UserController::class, 'update'])->name('update');
            Route::get('reset-password/{id}', [UserController::class, 'showFormResetPassword'])->name('reset_password');
            Route::put('reset-password/{id}', [UserController::class, 'resetPassword']);
            Route::post('handle/{id}', [UserController::class, 'handleAccount'])->name('handle');
        });

        Route::group(['as' => 'goods.', 'prefix' => 'hang-cuu-tro', 'middleware' => 'acl:goods.manage'], function () {
            Route::get('index', [GoodsController::class, 'index'])->name('index');
            Route::get('create', [GoodsController::class, 'create'])->name('create');
            Route::post('create', [GoodsController::class, 'store'])->name('store');
            Route::get('edit/{id}', [GoodsController::class, 'edit'])->name('edit');
            Route::put('update/{id}', [GoodsController::class, 'update'])->name('update');
        });

        Route::group(['as' => 'post.', 'prefix' => 'bai-viet', 'middleware' => 'acl:post.manage'], function () {
            Route::get('index', [PostController::class, 'index'])->name('index');
            Route::get('create', [PostController::class, 'create'])->name('create');
            Route::post('create', [PostController::class, 'store'])->name('store');
            Route::get('edit/{id}', [PostController::class, 'edit'])->name('edit');
            Route::put('update/{id}', [PostController::class, 'update'])->name('update');
            Route::delete('delete/{id}', [PostController::class, 'delete'])->name('delete');
        });

        Route::group(['as' => 'period.', 'prefix' => 'dot-ung-ho', 'middleware' => 'acl:period.manage'], function () {
            Route::get('index', [PeriodController::class, 'index'])->name('index');
            Route::get('create', [PeriodController::class, 'create'])->name('create');
            Route::post('create', [PeriodController::class, 'store'])->name('store');
            Route::get('edit/{id}', [PeriodController::class, 'edit'])->name('edit');
            Route::put('update/{id}', [PeriodController::class, 'update'])->name('update');
            Route::delete('delete/{id}', [PeriodController::class, 'delete'])->name('delete');
        });

        Route::group(['as' => 'family.', 'prefix' => 'gia-dinh', 'middleware' => 'acl:family.manage'], function () {
            Route::get('index', [FamilyController::class, 'index'])->name('index');
            Route::get('edit/{id}', [FamilyController::class, 'edit'])->name('edit');
            Route::put('update/{id}', [FamilyController::class, 'update'])->name('update');
        });

        Route::group(['prefix' => 'dang-ky', 'as' => 'registration.'], function() {
            Route::get('index', [AdminRegistrationSupportController::class, 'index'])->name('index');
            Route::get('detail/{id}', [AdminRegistrationSupportController::class, 'detail'])->name('detail');
            Route::post('confirm/{id}', [AdminRegistrationSupportController::class, 'confirm'])->name('confirm');
            Route::post('cancel/{id}', [AdminRegistrationSupportController::class, 'cancel'])->name('cancel');
        });

        Route::group(['as' => 'family_registration.', 'prefix' => 'dang-ky-gia-dinh', 'middleware' => 'acl:family.registration'], function () {
            Route::get('index', [FamilyRegistrationController::class, 'index'])->name('index');
            Route::get('detail/{periodId}', [FamilyRegistrationController::class, 'detail'])->name('detail');
            Route::post('register', [FamilyRegistrationController::class, 'register'])->name('register');
        });
        Route::group(['as' => 'handover.', 'prefix' => 'ban-giao', 'middleware' => 'acl:registration.manage'], function () {
            Route::get('index', [HandoverController::class, 'index'])->name('index');
            Route::get('{periodId}', [HandoverController::class, 'detail'])->name('detail');
            Route::post('{periodId}', [HandoverController::class, 'handover'])->name('handover');
            Route::get('print/{periodId}', [HandoverController::class, 'print'])->name('print');
        });
    });
});

// Client area
Route::group([], function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');

    Route::middleware('guest')->group(function () {
        Route::get('/login', [ClientAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [ClientAuthController::class, 'login']);

        Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [RegisterController::class, 'register']);
    });

    Route::middleware(['auth', 'auth_client'])->group(function () {
        Route::get('/logout', [ClientAuthController::class, 'logout'])->name('logout');
        Route::get('dang-ky-ung-ho', [RegistrationSupportController::class, 'index'])->name('registration');
        Route::get('lich-su', [RegistrationSupportController::class, 'history'])->name('history');
        Route::post('dang-ky-ung-ho', [RegistrationSupportController::class, 'save']);
        Route::put('dang-ky-ung-ho/huy/{id}', [RegistrationSupportController::class, 'cancel'])->name('registration.cancel');

        Route::group(['as' => 'profile.', 'prefix' => 'profile'], function () {
            Route::get('/', [ProfileController::class, 'info'])->name('info');
            Route::put('/', [ProfileController::class, 'updateInfo']);
            Route::get('/password', [ProfileController::class, 'showFormUpdatePassword'])->name('password');
            Route::put('/password', [ProfileController::class, 'updatePassword']);
        });
    });
});
