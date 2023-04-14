<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('user.index');
    }

    public function about()
    {
        return view('user.about');
    }
    
    public function subscriptions()
    {
        return view('user.subscriptions');
    }

    public function shop()
    {
        $products = Product::latest()->filter(request(['search']))->get();
        return view('e-commerce.shop', [
            'products' => $products,
        ]);
    }
    
    public function checkout()
    {
        $carts = Cart::where('user_id', auth()->id())->with('product')->get();
        $total = 0;

        foreach ($carts as $cart) {
            $total += $cart->quantity * $cart->product->price;
        }
        return view('e-commerce.checkout', [
            'carts' => $carts,
            'total' => $total,
        ]);
    }
    
    public function success()
    {
        return view('e-commerce.success');
    }

    
}
