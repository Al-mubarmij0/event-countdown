<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;


// Dashboard Route (Accessible to Admins and Users)
Route::get('/', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Event Routes (Authenticated users)
Route::middleware('auth')->group(function () {
    // List of user's events
    Route::get('/events', [EventController::class, 'index'])->name('events.index');

    // Create event form
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');  // Updated to match the route name
    Route::post('/events', [EventController::class, 'store'])->name('events.store');

    // Show event details (for both users and admins)
    Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
    
    // Route to see the event calendar
    Route::get('/events/calendar', [EventController::class, 'calendar'])->name('events.calendar');

    // Route for authenticated users to see their own events
    Route::get('/my-events', [EventController::class, 'myEvents'])->name('events.my');  // Updated route name
});

// Admin Routes (Admin only)
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Admin Manage Events
    Route::get('/events', [EventController::class, 'adminIndex'])->name('admin.events');

    // Admin Manage Users
    Route::get('/users', [AdminController::class, 'manageUsers'])->name('admin.users');

    // Admin Settings
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
});

// User Profile Routes (Authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication Routes
require __DIR__.'/auth.php';
