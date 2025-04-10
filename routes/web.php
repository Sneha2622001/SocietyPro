<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\NoticeController;
use Illuminate\Support\Facades\Auth;

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
        Route::get('/search', [UserController::class, 'search'])->name('user.search');
        Route::get('/add', [UserController::class, 'create'] )->name('user.add');
        Route::post('/store', [UserController::class, 'store'] )->name('user.store');
        Route::get('/{id}/edit', [UserController::class, 'edit'] )->name('user.edit');
        Route::post('/{id}/update', [UserController::class, 'update'] )->name('user.update');
        Route::delete('/{id}/delete', [UserController::class, 'destroy'] )->name('user.destroy');
    });
});

require __DIR__.'/auth.php';


// Building , Floor , Unit , Residents

// Building Routes
Route::get('/building',[BuildingController::class, 'index'])->name('building');
Route::get('/building/add',[BuildingController::class, 'create'])->name('building.add');
Route::post('/building/store',[BuildingController::class, 'store'])->name('building.store');
Route::get('/building/{id}/edit',[BuildingController::class, 'edit'])->name('building.edit');
Route::put('/building/{id}/update',[BuildingController::class, 'update'])->name('building.update');
Route::delete('/building/{id}/delete',[BuildingController::class, 'destroy'])->name('building.destroy');


//Floor Routes
Route::get('/floors', [FloorController::class, 'index'])->name('floor.index');
Route::get('/floors/create', [FloorController::class, 'create'])->name('floor.create');
Route::post('/floors/store', [FloorController::class, 'store'])->name('floor.store');
Route::get('/floors/edit/{floor}', [FloorController::class, 'edit'])->name('floor.edit');
Route::put('/floors/update/{floor}', [FloorController::class, 'update'])->name('floor.update');
Route::delete('/floors/delete/{floor}', [FloorController::class, 'destroy'])->name('floor.destroy');


// Unit Routes
Route::get('/units', [UnitController::class, 'index'])->name('units.index');
Route::get('/units/create', [UnitController::class, 'create'])->name('units.create'); 
Route::post('/units', [UnitController::class, 'store'])->name('units.store'); 
Route::get('/units/{unit}/edit', [UnitController::class, 'edit'])->name('units.edit'); 
Route::put('/units/{unit}', [UnitController::class, 'update'])->name('units.update'); 
Route::delete('/units/{unit}', [UnitController::class, 'destroy'])->name('units.destroy'); 



// Resident Routes
Route::get('/residents', [ResidentController::class, 'index'])->name('residents.index');
Route::get('/residents/create', [ResidentController::class, 'create'])->name('residents.create');
Route::post('/residents/store', [ResidentController::class, 'store'])->name('residents.store');
Route::get('/residents/edit/{id}', [ResidentController::class, 'edit'])->name('residents.edit');
Route::put('/residents/update/{id}', [ResidentController::class, 'update'])->name('residents.update');
Route::delete('/residents/delete/{id}', [ResidentController::class, 'destroy'])->name('residents.destroy');


// Routes for Residents

    Route::middleware(['auth'])->group(function () {
    Route::get('/complaints', [ComplaintController::class, 'userComplaints'])->name('complaints.user');
    Route::get('/complaints/create', [ComplaintController::class, 'create'])->name('complaints.create');
    Route::post('/complaints', [ComplaintController::class, 'store'])->name('complaints.store');
    Route::delete('/complaints/{complaint}', [ComplaintController::class, 'destroy'])->name('complaints.destroy');

     // Notification Routes (For Residents)
     Route::patch('/notifications/{id}/read', function ($id) {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        return redirect()->back();
    })->name('notifications.read');
});


// Routes for Admin & Staff

    Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/complaints', [ComplaintController::class, 'index'])->name('complaints.index');
    Route::post('/complaints/{complaint}/update', [ComplaintController::class, 'updateStatus'])->name('complaints.updateStatus');
    Route::get('/complaints/{complaint}/edit', [ComplaintController::class, 'edit'])->name('complaints.edit');
    Route::put('/complaints/{complaint}', [ComplaintController::class, 'update'])->name('complaints.update');
    // Route::delete('/complaints/{complaint}', [ComplaintController::class, 'destroy'])->name('complaints.destroy');
    Route::get('/complaints/{complaint}', [ComplaintController::class, 'show'])->name('complaints.show');
});


//Notice Routes

    Route::get('/notices', [NoticeController::class, 'index'])->name('notices.index');

    
        Route::get('/notices/create', [NoticeController::class, 'create'])->name('notices.create');
        Route::post('/notices', [NoticeController::class, 'store'])->name('notices.store');
 

    Route::get('/notices/{notice}', [NoticeController::class, 'show'])->name('notices.show');
    Route::get('/notices/{notice}/edit', [NoticeController::class, 'edit'])->name('notices.edit');
    Route::put('/notices/{notice}', [NoticeController::class, 'update'])->name('notices.update');
    Route::delete('/notices/{notice}', [NoticeController::class, 'destroy'])->name('notices.destroy');