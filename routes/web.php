<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;



Route::get('/admin', [AdminController::class, 'index']);
Route::get('/residents', [ResidentController::class, 'index']);
Route::get('/security', [ResidentController::class, 'index']);
Route::get('/staff', [ResidentController::class, 'index']);


Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', 'role:Resident'])->group(function () {
    Route::get('/resident', [ResidentController::class, 'index'])->name('resident.dashboard');
});

Route::middleware(['auth', 'role:Security'])->group(function () {
    Route::get('/security', [SecurityController::class, 'index'])->name('security.dashboard');
});

Route::middleware(['auth', 'role:Staff'])->group(function () {
    Route::get('/staff', [StaffController::class, 'index'])->name('staff.dashboard');
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


//-----------------------//


// Dashboard Route
Route::get('/', function () {
    return view('layouts.dashboard'); // Updated path for dashboard
})->name('dashboard');

// // Role Route
// Route::get('/role', function () {
//     return view('users.role'); // Updated path for users
// })->name('role');



Route::get('/role', [RoleController::class, 'index'])->name('role');
Route::get('/role/create', [RoleController::class, 'create'])->name('role.create'); // Open Add Role Form
Route::post('/role/store', [RoleController::class, 'store'])->name('role.store');
Route::get('/role/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
Route::put('/role/{id}/update', [RoleController::class, 'update'])->name('role.update');
Route::delete('/role/{id}/delete', [RoleController::class, 'destroy'])->name('role.destroy');

// // Users Route
// Route::get('/users', function () {
//     return view('users.users'); // Updated path for users
// })->name('users');

// Route::resource('users', UserController::class);

Route::get('/users', [UserController::class, 'index'])->name('users.index'); // Show all users
Route::post('/users', [UserController::class, 'store'])->name('users.store'); // Store new user
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit'); // Show edit form
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update'); // Update user
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy'); // Delete user


// Owners Route
Route::get('/owners', function () {
    return view('users.owners'); // Updated path for owners
})->name('owners');

// Settings Route
Route::get('/settings', function () {
    return view('users.settings'); // Updated path for settings
})->name('settings');
