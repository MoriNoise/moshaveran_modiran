<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Notification\NotificationController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\DashboardController;

Route::prefix('admin')->name('admin.')->group(function () {

    /**
     * Authentication Routes
     */
    Route::prefix('auth')->name('auth.')->controller(AuthController::class)->group(function () {
        Route::middleware('guest:admin')->group(function () {
            Route::get('/login', 'showLoginForm')->name('login.form');
            Route::post('/login', 'login')->name('login');
            // Route::get('/register', 'showRegisterForm')->name('register.form');
            // Route::post('/register', 'register')->name('register');
        });

        Route::middleware('auth:admin')->group(function () {
            Route::get('/logout', 'logout')->name('logout');
        });
    });

    /**
     * Authenticated Admin Routes
     */
    Route::middleware('auth:admin')->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('index');

        /**
         * Users
         */
        Route::prefix('users')->name('users.')->controller(UserController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('{user}', 'show')->name('show');
            Route::get('/{user}/edit', 'edit')->name('edit');
            Route::put('/{user}/edit', 'update')->name('update');
            Route::delete('/{user}', 'destroy')->name('destroy');
            // routes/web.php
            Route::get('/import/vcf',  'importForm')->name('import.vcf');
            Route::post('/import/vcf',  'importVcf')->name('import.vcf.store');

        });


        /**
         * Notifications
         */
        Route::prefix('notifications')->name('notifications.')->controller(NotificationController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('{notification}', 'show')->name('show');
            Route::get('/{notification}/edit', 'edit')->name('edit');
            Route::put('/{notification}/edit', 'update')->name('update');
            Route::delete('/{notification}', 'destroy')->name('destroy');
        });
        /**
         * Admins
         */
        Route::prefix('admins')->name('admins.')->controller(AdminController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('{admin}', 'show')->name('show');
            Route::get('/{admin}/edit', 'edit')->name('edit');
            Route::put('/{admin}/edit', 'update')->name('update');
            Route::delete('/{admin}', 'destroy')->name('destroy');
        });

    });
});
