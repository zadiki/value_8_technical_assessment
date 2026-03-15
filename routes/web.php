<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // Display the Login Form
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('register', [AuthenticatedSessionController::class, 'register']);
    // Handle the Login Submission
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('resetpassword', function () {
        return view('auth.reset-password');
    })->name('reset-password');
    Route::post('resetpassword', function () {})->name('reset-password.post');
});

Route::middleware('auth')->group(function () {
    // The Dashboard (where users go after login)
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    // Handle Logout
    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
    Route::get('register', [AuthenticatedSessionController::class, 'createRegistration'])
        ->name('register');

});

// order view routes
Route::middleware('auth')->prefix('order')->group(function () {
    Route::get('/view-orders', function () {
        return view('view-orders');
    })->name('viewOrders');
    Route::get('/create-order', function () {
        return view('view-create-order');
    })->name('createOrder');
    Route::get('/edit-order', function () {
        return view('view-edit-order');
    })->name('editOrder');

});

Route::middleware('auth')->prefix('delivery-notes')->group(function () {
    Route::get('/', function () {
        return view('view-delivery-note');
    })->name('deliveryNotes');

});

Route::middleware('auth')->prefix('inventory')->group(function () {
    Route::get('/shop-inventory', function () {
        return view('view-shop-inventory');
    })->name('shopInventory');
    Route::get('/branch-inventory', function () {
        return view('view-branch-inventory');
    })->name('branchInventory');
    Route::get('/master-inventory', function () {
        return view('view-master-inventory');
    })->name('masterInventory');
    Route::get('/inventory-report', function () {
        return view('view-inventory-report');
    })->name('inventoryReport');
    Route::get('/pending-adjustments', function () {
        return view('view-pending-adjustments');
    })->name('pendingAdjustments');
});

Route::middleware('auth')->prefix('sales')->group(function () {
    Route::get('/shop-sales', function () {
        return view('view-shop-sales');
    })->name('shopSales');
    Route::get('/branch-sales', function () {
        return view('view-branch-sales');
    })->name('branchSales');
    Route::get('/master-sales', function () {
        return view('view-master-sales');
    })->name('masterSales');
    Route::get('/sales-report', function () {
        return view('view-sales-report');
    })->name('salesReport');
});

// json return routes
Route::middleware('auth')->prefix('api')->group(function () {

    // product routes json
    Route::get('/products/active', [ProductController::class, 'getActiveProducts'])
        ->name('activeProducts');

    // user routes json
    Route::get('/users/active-users', [UserController::class, 'getAllActiveUsers'])
        ->name('activeUsers');

    // order view jsons
    Route::get('/order/all-orders', [OrderController::class, 'getAllOrders'])->name('allOrders');

});
