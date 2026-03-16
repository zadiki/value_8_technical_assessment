<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Branch;
use App\Models\Store;
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
    Route::get('/store-inventory', function () {
        return view('view-store-inventory');
    })->name('storeInventory');
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
    Route::get('/store-sales', function () {
        return view('view-store-sales');
    })->name('storeSales');
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

Route::middleware('auth')->prefix('stores')->group(function () {
    Route::get('/', function () {
        $stores = Store::paginate(10);

        return view('view-stores', ['stores' => $stores]);
    })->name('stores');
    Route::get('/create-store', function () {
        // return view('view-create-store');
    })->name('createStore');
});

Route::middleware('auth')->prefix('branches')->group(function () {
    Route::get('/', function () {
        $branches = Branch::paginate(10);

        return view('view-branches', ['branches' => $branches]);
    })->name('branches');
    Route::get('/create-branch', function () {
        // return view('view-create-branch');
    })->name('createBranch');
});

Route::middleware('auth')->prefix('users')->group(function () {
    Route::get('/', function () {
        return view('view-users');
    })->name('viewUsers');
    Route::get('/create-user', function () {
        // return view('view-create-user');
    })->name('createUser');
});

Route::middleware('auth')->prefix('products')->group(function () {
    Route::get('/active', function () {
        return view('view-active-products');
    })->name('activeProducts');

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
