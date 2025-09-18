<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductAdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use App\Models\Product;
use App\Models\Authentication;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderAdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/', [LandingPageController::class, 'index'])->name('home');
Route::resource('products', ProductController::class);
Route::post('/products/{product}/click', [ProductController::class, 'recordClick'])->name('products.click');


//laravel breeze default

Route::middleware('auth')->group(function () {
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/order-details', [DashboardController::class, 'getOrderDetails'])->name('admin.orders.details');
        Route::patch('/admin/orders/{order}/update-status', [OrderAdminController::class, 'updateStatus'])->name('admin.orders.updateStatus');
        Route::get('/admin-orders', [OrderAdminController::class, 'index'])->name('admin.orders.index');
        Route::resource('admin-products', ProductAdminController::class)->parameters([
            'admin-products' => 'product'
        ]);

        Route::resource('product-category', ProductCategoryController::class);
    });
    Route::middleware('customer')->group(function () {

        Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{orderId}/whatsapp-message', [OrderController::class, 'whatsappMessage'])->name('order.message');


        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
        Route::put('/cart', [CartController::class, 'update'])->name('cart.update'); // Diubah: tidak lagi memerlukan parameter {id} di URI
        Route::delete('/cart/destroy-selected', [CartController::class, 'destroySelected'])->name('cart.destroy_selected');

        // Route::get('/checkout',[CheckoutController::class,'singleItemCheckout'])->name('checkout.singleItem');
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
        Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
        Route::post('/checkout/single-item/{id}', [CheckoutController::class, 'singleItemCheckout'])->name('checkout.singleItem');
        Route::get('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
    });
    Route::resource('profile', ProfileController::class)->only([
        'edit',
        'update',
        'destroy'
    ]);
});

require __DIR__ . '/auth.php';
