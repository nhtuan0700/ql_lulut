<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return view('welcome');
});

// ADMIN AREA
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth', 'auth_admin'])->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('index');


        Route::group(['as' => 'user.', 'prefix' => 'user', 'middleware' => 'acl:user.manage'], function () {
            Route::get('index', [UserController::class, 'index'])->name('index');
            Route::get('search', [UserController::class, 'search'])->name('search');
            Route::get('create', [UserController::class, 'create'])->name('create');
            Route::post('create', [UserController::class, 'store'])->name('store');
            Route::get('edit/{id?}', [UserController::class, 'edit'])->name('edit');
            Route::put('update/{id?}', [UserController::class, 'update'])->name('update');
            Route::get('reset-password/{id}', [UserController::class, 'showFormResetPassword'])->name('reset_password');
            Route::put('reset-password/{id}', [UserController::class, 'resetPassword']);
            Route::post('handle/{id}', [UserController::class, 'handleAccount'])->name('handle');
        });
    });
});