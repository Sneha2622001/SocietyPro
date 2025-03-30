<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified', 'role'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/roles', [RoleController::class, 'index'])->name('roles');
    Route::prefix('role')->group(function (){
        Route::get('/add', [RoleController::class, 'create'])->name('role.add');
        Route::post('/store', [RoleController::class, 'store'])->name('role.store');
        Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
        Route::put('/{id}/update', [RoleController::class, 'update'])->name('role.update');
        Route::delete('/{id}/delete', [RoleController::class, 'destroy'])->name('role.destroy');
    });

    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::prefix('user')->group(function (){
        Route::get('/add', [UserController::class, 'create'] )->name('user.add');
        Route::post('/store', [UserController::class, 'store'] )->name('user.store');
        // Route::get('/store', [UserController::class, 'store'] )->name('user.store');
        // Route::post('/store', function () {
        //     return view('user.user-add');
        // })->name('user.store');
        Route::get('/{id}/edit', function () {
            return view('user.user-edit');
        })->name('user.edit');
        Route::put('/{id}/update', function () {
            return view('user.users');
        })->name('user.update');
        Route::delete('/{id}/delete', function () {
            return view('user.users');
        })->name('user.destroy');
    });
});

require __DIR__.'/auth.php';
