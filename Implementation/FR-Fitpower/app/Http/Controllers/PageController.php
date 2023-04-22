<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PageController extends Controller
{
    public function home()
    {
        $subscriptions = Subscription::all();
        foreach ($subscriptions as $subscription) {
            $subscription->includes = explode(',', $subscription->includes);
        }
        return view('user.index', [
            'subscriptions' => $subscriptions,
        ]);
    }

    public function about()
    {
        return view('user.about');
    }

    public function subscriptions()
    {
        $subscriptions = Subscription::all();
        foreach ($subscriptions as $subscription) {
            $subscription->includes = explode(',', $subscription->includes);
        }
        return view('user.subscriptions', [
            'subscriptions' => $subscriptions,
        ]);
    }

    public function shop()
    {
        $products = Product::latest()->filter(request(['search', 'category']))->get();
        return view('e-commerce.shop', [
            'products' => $products,
        ]);
    }

    public function subPayment()
    {
    }

    public function checkout()
    {
        $carts = Cart::where('user_id', auth()->id())->with('product')->get();
        $total = 0;

        foreach ($carts as $cart) {
            if (!$cart->product->stock <= 0 || $cart->product->stock < $cart->quantity) {
                $total += $cart->quantity * $cart->product->price;
            } else {
                $cart->product->outStock = true;
            }
        }
        return view('e-commerce.checkout', [
            'carts' => $carts,
            'total' => $total,
        ]);
    }

    public function buySubs(Subscription $subscription)
    {
        $subscription->includes = explode(',', $subscription->includes);
        return view('e-commerce.buySubs', [
            'subscription' => $subscription,
        ]);
    }
    public function orderDetails(Order $order)
    {
        Redirect::setIntendedUrl(url()->previous());
        return view('e-commerce.order-details', [
            'order' => $order,
        ]);
    }

    public function success()
    {
        return view('e-commerce.success');
    }
    public function cancel()
    {
        return view('e-commerce.cancel');
    }
}
