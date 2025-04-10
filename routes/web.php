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
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\BookingPaymentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\NoticeController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'verified', 'roleAndPermission'])->group(function () {
    // Dashboard
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    // Role Routes
    Route::get('/roles', [RoleController::class, 'index'])->name('roles');
    Route::prefix('role')->group(function (){
        Route::get('/add', [RoleController::class, 'create'])->name('role.add');
        Route::post('/store', [RoleController::class, 'store'])->name('role.store');
        Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
        Route::put('/{id}/update', [RoleController::class, 'update'])->name('role.update');
        Route::delete('/{id}/delete', [RoleController::class, 'destroy'])->name('role.destroy');
    });

    // User Routes
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::prefix('user')->group(function (){
        Route::get('/search', [UserController::class, 'search'])->name('user.search');
        Route::get('/add', [UserController::class, 'create'] )->name('user.add');
        Route::post('/store', [UserController::class, 'store'] )->name('user.store');
        Route::get('/{id}/edit', [UserController::class, 'edit'] )->name('user.edit');
        Route::post('/{id}/update', [UserController::class, 'update'] )->name('user.update');
        Route::delete('/{id}/delete', [UserController::class, 'destroy'] )->name('user.destroy');
    });

    // Building Routes
    Route::prefix('building')->group(function (){
        Route::get('/',[BuildingController::class, 'index'])->name('building');
        Route::get('/add',[BuildingController::class, 'create'])->name('building.add');
        Route::post('/store',[BuildingController::class, 'store'])->name('building.store');
        Route::get('/{id}/edit',[BuildingController::class, 'edit'])->name('building.edit');
        Route::put('/{id}/update',[BuildingController::class, 'update'])->name('building.update');
        Route::delete('/{id}/delete',[BuildingController::class, 'destroy'])->name('building.destroy');
    });

    // Floor Routes
    Route::prefix('floors')->group(function (){
        Route::get('', [FloorController::class, 'index'])->name('floor.index');
        Route::get('/create', [FloorController::class, 'create'])->name('floor.create');
        Route::post('/store', [FloorController::class, 'store'])->name('floor.store');
        Route::get('/edit/{floor}', [FloorController::class, 'edit'])->name('floor.edit');
        Route::put('/update/{floor}', [FloorController::class, 'update'])->name('floor.update');
        Route::delete('/delete/{floor}', [FloorController::class, 'destroy'])->name('floor.destroy');
    });
    
    // Unit Routes
    Route::prefix('units')->group(function (){
        Route::get('', [UnitController::class, 'index'])->name('units.index');
        Route::get('/create', [UnitController::class, 'create'])->name('units.create');
        Route::post('/store', [UnitController::class, 'store'])->name('units.store');
        Route::get('/edit/{unit}', [UnitController::class, 'edit'])->name('units.edit');
        Route::put('/update/{unit}', [UnitController::class, 'update'])->name('units.update');
        Route::delete('/delete/{unit}', [UnitController::class, 'destroy'])->name('units.destroy');
    });

    // Resident Routes
    Route::prefix('residents')->group(function (){
        Route::get('', [ResidentController::class, 'index'])->name('residents.index');
        Route::get('/create', [ResidentController::class, 'create'])->name('residents.create');
        Route::post('/store', [ResidentController::class, 'store'])->name('residents.store');
        Route::get('/edit/{id}', [ResidentController::class, 'edit'])->name('residents.edit');
        Route::put('/update/{id}', [ResidentController::class, 'update'])->name('residents.update');
        Route::delete('/delete/{id}', [ResidentController::class, 'destroy'])->name('residents.destroy');
    });

    // Notification Routes (For Residents)
    Route::patch('/notifications/{id}/read', function ($id) {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        return redirect()->back();
    })->name('notifications.read');

    // Complaint Routes
    Route::prefix('complaints')->group(function (){
        Route::get('', [ComplaintController::class, 'index'])->name('complaints.user');
        Route::get('/{complaint}', [ComplaintController::class, 'show'])->name('complaints.show');
        Route::get('/create', [ComplaintController::class, 'create'])->name('complaints.create');
        Route::post('/store', [ComplaintController::class, 'store'])->name('complaints.store');
        Route::get('/{complaint}/edit', [ComplaintController::class, 'edit'])->name('complaints.edit');
        Route::put('/{complaint}', [ComplaintController::class, 'update'])->name('complaints.update');
        Route::put('/{complaint}/update', [ComplaintController::class, 'updateStatus'])->name('complaints.updateStatus');
        // Route::delete('/{complaint}/delete', [ComplaintController::class, 'destroy'])->name('complaints.destroy');
    });

    // Facility Routes
    Route::prefix('facilities')->group(function (){
        Route::get('', [FacilityController::class, 'index'])->name('facilities.index');
        Route::get('/{facility}', [FacilityController::class, 'show'])->name('facilities.show');
    });
    
    // Booking Routes
    Route::prefix('my-bookings')->group(function (){
        Route::get('', [BookingController::class, 'myBookings'])->name('bookings.bookings');
        Route::post('/store', [BookingController::class, 'store'])->name('bookings.store');
        Route::get('/{booking}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
        Route::put('/{booking}', [BookingController::class, 'update'])->name('bookings.update');
        Route::delete('/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
    });

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    // Billing Routes
    Route::get('/my-bills', [BillingController::class, 'index'])->name('bills.index');
    Route::get('/bills/{bill}/pay', [PaymentController::class, 'pay'])->name('bills.pay');
    Route::post('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');
    Route::get('/bookings/{booking}/pay', [BookingPaymentController::class, 'initiatePayment'])->name('bookings.pay');
    Route::post('/bookings/payment/callback', [BookingPaymentController::class, 'handleCallback'])->name('bookings.payment.callback');

    // Permission Routes
    Route::prefix('permissions')->group(function (){
        Route::get('/manage', [PermissionController::class, 'managePermissions'])->name('permissions.manage');
        Route::post('/save', [PermissionController::class, 'savePermissions'])->name('permissions.save');
    });


    // Admin Routes
    Route::prefix('/admin')->group(function (){
        // Complaint Admin Routes
        Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaints.index');

        // Facility Admin Routes
        Route::get('/facilities/create', [FacilityController::class, 'create'])->name('facilities.create');
        Route::post('/facilities', [FacilityController::class, 'store'])->name('facilities.store');
        Route::get('/facilities/{facility}/edit', [FacilityController::class, 'edit'])->name('facilities.edit');
        Route::put('/facilities/{facility}', [FacilityController::class, 'update'])->name('facilities.update');
        Route::delete('/facilities/{facility}', [FacilityController::class, 'destroy'])->name('facilities.destroy');

        // Billing Admin Routes
        Route::get('/bookings', [BookingController::class, 'adminIndex'])->name('admin.bookings.index');
        Route::post('/bookings/{booking}/update-status', [BookingController::class, 'updateStatus'])->name('admin.bookings.updateStatus');
    });

    // Notice Routes
    Route::prefix('notices')->group(function (){
        Route::get('/', [NoticeController::class, 'index'])->name('notices.index');
        Route::get('/create', [NoticeController::class, 'create'])->name('notices.create');
        Route::post('/store', [NoticeController::class, 'store'])->name('notices.store');    
        Route::get('/store/{notice}', [NoticeController::class, 'show'])->name('notices.show');
        Route::get('/store/{notice}/edit', [NoticeController::class, 'edit'])->name('notices.edit');
        Route::put('/store/{notice}', [NoticeController::class, 'update'])->name('notices.update');
        Route::delete('/store/{notice}', [NoticeController::class, 'destroy'])->name('notices.destroy');
    });
});

require __DIR__.'/auth.php';