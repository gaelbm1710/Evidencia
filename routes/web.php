<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\DashboardController;

Route::get('/', [PublicController::class, 'home'])->name('public.home');
Route::post('/search', [PublicController::class, 'search'])->name('public.search');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserController::class);
    });

    Route::resource('orders', OrderController::class);
    Route::get('orders-archived', [OrderController::class, 'archived'])->name('orders.archived');
    Route::post('orders/{id}/restore', [OrderController::class, 'restore'])->name('orders.restore');
    Route::post('orders/{order}/change-status', [OrderController::class, 'changeStatus'])->name('orders.changeStatus');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware(['auth'])
        ->name('dashboard');
});

require __DIR__ . '/auth.php';
