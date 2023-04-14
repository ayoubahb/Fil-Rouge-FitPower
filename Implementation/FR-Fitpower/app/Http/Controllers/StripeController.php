<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class StripeController extends Controller
{

    public function payment()
    {
        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();

        $lineItems = [];

        foreach ($cartItems as $cartItem) {
            $product = $cartItem->product;
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'USD',
                    'product_data' => [
                        'name' => $product->name,
                    ],
                    'unit_amount' => $product->price * 100,
                ],
                'quantity' => $cartItem->quantity,
            ];
        }
        // dd($lineItems);
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $session = \Stripe\Checkout\Session::create([
            'line_items'  => $lineItems,
            'mode'        => 'payment',
            'success_url' => route('stripe.success'),
            'cancel_url'  => route('payment.cancel'),
        ]);

        return redirect()->away($session->url);
    }

    public function success()
    {
        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
        $products = [];
        $total = 0;
        foreach ($cartItems as $cartItem) {
            $product = $cartItem->product;
            $products[$product->id] = ['quantity' => $cartItem->quantity];
            $total += $product->price * $cartItem->quantity;

            $newStockQuantity = $product->stock - $cartItem->quantity;
            $product->update(['stock' => $newStockQuantity]);
        }

        $order = session()->get('orderData');

        $order['total'] = $total;
        $order['payment_status'] = 'Paid';
        $order['order_status'] = 'In progress';
        $order['products'] = $products;

        $orderCreate = Order::create($order);

        $orderCreate->products()->attach($order['products']);

        foreach ($cartItems as $cartItem) {
            $cartItem->delete();
        }
        return redirect()->route('success')->with('paymentsuccess', 'Your payment is completed');
    }

    public function cancel()
    {
    }
}
