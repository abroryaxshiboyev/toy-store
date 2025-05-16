<?php

use App\Http\Controllers\ToyController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\ToyController as AdminToyController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [ToyController::class, 'index'])->name('home');
Route::get('/toys', [ToyController::class, 'index'])->name('toys.index');
Route::get('/toys/{toy}', [ToyController::class, 'show'])->name('toys.show');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

// /admin marshruti
Route::get('/admin', function () {
    if (Auth::check()) {
        return redirect()->route('admin.toys.index');
    }
    return view('auth.login');
})->name('login');

Route::post('/admin', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/toys', [AdminToyController::class, 'index'])->name('admin.toys.index');
    Route::get('/toys/create', [AdminToyController::class, 'create'])->name('admin.toys.create');
    Route::post('/toys', [AdminToyController::class, 'store'])->name('admin.toys.store');
    Route::get('/toys/{toy}/edit', [AdminToyController::class, 'edit'])->name('admin.toys.edit');
    Route::put('/toys/{toy}', [AdminToyController::class, 'update'])->name('admin.toys.update');
    Route::delete('/toys/{toy}', [AdminToyController::class, 'destroy'])->name('admin.toys.destroy');
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
});

Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');