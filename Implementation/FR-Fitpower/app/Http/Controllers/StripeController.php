<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ClientSubscription;

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
        session()->forget('orderData');
        
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
    public function paymentSubs($id)
    {
        $hasSub = ClientSubscription::where('user_id', auth()->id())
            ->where('date_end', '>=', Carbon::now()->toDateString())
            ->orderBy('date_end', 'desc')
            ->exists();

        if ($hasSub) {
            return back()->with('error','Already have an active subscription');
        }
        $subscription = Subscription::findOrFail($id);
        session()->put('subscription_id', $id);
        $lineItems = [
            [
                'price_data' => [
                    'currency' => 'USD',
                    'product_data' => [
                        'name' => $subscription->name,
                    ],
                    'unit_amount' => $subscription->price * 100,
                ],
                'quantity' => '1',
            ]
        ];


        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $session = \Stripe\Checkout\Session::create([
            'line_items'  => $lineItems,
            'mode'        => 'payment',
            'success_url' => route('stripesub.success'),
            'cancel_url'  => route('cancel'),
        ]);

        return redirect()->away($session->url);
    }

    public function successSub()
    {
        $subscription = [
            'user_id' => auth()->id(),
            'subscription_id' => session()->get('subscription_id'),
            'date_start' => Carbon::now(),
            'date_end' => Carbon::now()->addMonth(),
        ];

        ClientSubscription::create($subscription);

        return redirect()->route('success')->with('paymentsuccess', 'Your payment is completed');
    }
}
