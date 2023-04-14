<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

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

/* ------------------- Admin Route ------------------- */

Route::prefix('admin')->group(function () {

    Route::get('/login', [AdminController::class, 'index'])->name('login_admin');
    Route::post('/authenticate', [AdminController::class, 'authenticate'])->name('admin.authenticate');

    Route::middleware('admin')->group(function () {
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders');
        Route::get('/subscriptions', [AdminController::class, 'subsDash'])->name('admin.subscriptions');
        Route::get('/products', [ProductController::class, 'index'])->name('admin.products');
        Route::get('/products/create', [ProductController::class, 'create'])->name('create.product');
        Route::post('/products/store', [ProductController::class, 'store'])->name('store.product');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('edit.product');
        Route::put('/products/{product}/update', [ProductController::class, 'update'])->name('update.product');
        Route::delete('/products/{product}/delete', [ProductController::class, 'destroy'])->name('delete.product');
    });
});
/* ------------------- Admin Route ------------------- */



Route::get('/',[PageController::class, 'home'])->name('Home');
Route::get('/about',[PageController::class, 'about'])->name('About');
Route::get('/subscriptions',[PageController::class, 'subscriptions'])->name('Subscriptions');
Route::get('/checkout', [PageController::class, 'checkout'])->name('Checkout')->middleware('auth');
Route::get('/shop', [PageController::class, 'shop'])->name('Shop');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
});
Route::get('/product/{product}', [ProductController::class, 'show']);

Route::post('/createorder', [OrderController::class, 'store'])->name('create.order');
Route::get('/success', [PageController::class, 'success'])->name('success');

Route::get('/stripepayment', [StripeController::class, 'payment'])->name('stripe.payment')->middleware('auth');
Route::get('/stripepaymentsuccess', [StripeController::class, 'success'])->name('stripe.success')->middleware('auth');

Route::get('/paypalpayment', [PayPalController::class, 'payment'])->name('paypal.payment')->middleware('auth');
Route::get('/paypalpaymentsuccess', [PayPalController::class, 'success'])->name('payment.success')->middleware('auth');
Route::get('/paypalpaymentcancel', [PayPalController::class, 'cancel'])->name('payment.cancel')->middleware('auth');




require __DIR__ . '/auth.php';
