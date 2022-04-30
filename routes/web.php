<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\GoodsController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\HomeController;
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
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth', 'auth_admin'])->group(function () {
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

        Route::group(['as' => 'goods.', 'prefix' => 'hang-cuu-tro', 'middleware' => 'acl:goods.manage'], function() {
            Route::get('index', [GoodsController::class, 'index'])->name('index');
            Route::get('create', [GoodsController::class, 'create'])->name('create');
            Route::post('create', [GoodsController::class, 'store'])->name('store');
            Route::get('edit/{id}', [GoodsController::class, 'edit'])->name('edit');
            Route::put('update/{id}', [GoodsController::class, 'update'])->name('update');
        });

        Route::group(['as' => 'post.', 'prefix' => 'bai-viet', 'middleware' => 'acl:post.manage'], function() {
            Route::get('index', [PostController::class, 'index'])->name('index');
            Route::get('create', [PostController::class, 'create'])->name('create');
            Route::post('create', [PostController::class, 'store'])->name('store');
            Route::get('edit/{id}', [PostController::class, 'edit'])->name('edit');
            Route::put('update/{id}', [PostController::class, 'update'])->name('update');
            Route::delete('delete/{id}', [PostController::class, 'delete'])->name('delete');
        });
    });
});

// Client area
Route::get('/', [HomeController::class, 'index'])->name('index');