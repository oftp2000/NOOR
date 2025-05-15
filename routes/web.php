<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ClientController;


// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Authenticated user routes (both regular users and admins)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function() {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('packages', PackageController::class)->except(['show']);
     Route::resource('reservations', ReservationController::class);
     Route::resource('clients', ClientController::class);
});

// Regular user routes
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function() {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    // Other user routes...
});

require __DIR__.'/auth.php';