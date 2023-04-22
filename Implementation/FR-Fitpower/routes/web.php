<?php

use GuzzleHttp\Middleware;
use App\Models\Subscription;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ClientSubscriptionController;

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
        Route::get('/orders', [OrderController::class, 'index'])->name('Admin - Orders');
        Route::get('/orders/{order}/details', [OrderController::class, 'show'])->name('Orders details');

        Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('Admin - Subscriptions');
        Route::get('/subscriptions/create', [SubscriptionController::class, 'create'])->name('Create subscription');
        Route::post('/subscriptions/store', [SubscriptionController::class, 'store'])->name('store.subscription');
        Route::get('/subscription/{subscription}/edit', [SubscriptionController::class, 'edit'])->name('Edit subscription');
        Route::put('/subscription/{subscription}/update', [SubscriptionController::class, 'update'])->name('update.subscription');
        Route::delete('/subscription/{subscription}/delete', [SubscriptionController::class, 'destroy'])->name('delete.subscription');

        Route::get('/clientsubs', [ClientSubscriptionController::class, 'index'])->name('Admin - Clients subscriptions');

        Route::get('/products', [ProductController::class, 'index'])->name('Admin - Products');
        Route::get('/products/create', [ProductController::class, 'create'])->name('create.product');
        Route::post('/products/store', [ProductController::class, 'store'])->name('store.product');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('edit.product');
        Route::put('/products/{product}/update', [ProductController::class, 'update'])->name('update.product');
        Route::delete('/products/{product}/delete', [ProductController::class, 'destroy'])->name('delete.product');

        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    });
});
/* ------------------- Admin Route ------------------- */


Route::get('/',[PageController::class, 'home'])->name('Home');
Route::get('/about',[PageController::class, 'about'])->name('About');
Route::get('/subscriptions',[PageController::class, 'subscriptions'])->name('Subscriptions');
Route::get('/shop', [PageController::class, 'shop'])->name('Shop');
Route::get('/product/{product}', [ProductController::class, 'show']);



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::get('/checkout', [PageController::class, 'checkout'])->name('Checkout');
    Route::get('/checkoutSub/{subscription}', [PageController::class, 'buySubs'])->name('Checkout subscription');
    Route::post('/createorder', [OrderController::class, 'store'])->name('create.order');
    
    Route::post('/stripepaymentsub/{id}', [StripeController::class, 'paymentSubs'])->name('stripesub.payment');
    Route::get('/stripesubpaymentsuccess', [StripeController::class, 'successSub'])->name('stripesub.success');

    Route::get('/stripepayment', [StripeController::class, 'payment'])->name('stripe.payment');
    Route::get('/stripepaymentsuccess', [StripeController::class, 'success'])->name('stripe.success');
    
    
    Route::get('/paypalpayment', [PayPalController::class, 'payment'])->name('paypal.payment');
    Route::get('/paypalpaymentsuccess', [PayPalController::class, 'success'])->name('payment.success');
    Route::get('/paypalpaymentcancel', [PayPalController::class, 'cancel'])->name('payment.cancel');
    
    Route::post('/paypalsub/{id}', [PayPalController::class, 'paymentSubs'])->name('paymentsub');
    Route::get('/paypalpaymentsubsuccess', [PayPalController::class, 'successSub'])->name('paymentsub.success');

    Route::put('/order/{order}/confirm', [OrderController::class, 'update'])->name('order.update');

    
    Route::get('/orders/{order}/details', [PageController::class, 'orderDetails'])->name('Order details');
    Route::get('/success', [PageController::class, 'success'])->name('success');
    Route::get('/cancel', [PageController::class, 'cancel'])->name('cancel');
});





require __DIR__ . '/auth.php';
