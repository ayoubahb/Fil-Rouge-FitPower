<?php

namespace App\Http\Controllers;

use App\Models\Cart;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{
    public $provider;

    public function __construct()
    {
        $this->provider = new PayPalClient;
        $this->provider->getAccessToken();
    }

    public function payment()
    {
        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
        // Initialize the purchase units array
        $purchaseUnits = [];
        $total = 0;
        // Loop through each cart item and add it to the purchase units array
        foreach ($cartItems as $cartItem) {
            $product = $cartItem->product;

            $unit = [
                'name' => $product->name,
                'quantity' => $cartItem->quantity,
                'unit_amount' => [
                    'currency_code' => 'USD',
                    'value' => $product->price
                ]
            ];

            $purchaseUnits[] = $unit;
            $total += $product->price * $cartItem->quantity;
        }

        // Set the purchase units and application context fields in the order array
        $order = [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'items' => $purchaseUnits,
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => $total,
                        'breakdown' => [
                            'item_total' => [
                                'currency_code' => 'USD',
                                'value' => $total
                            ],
                        ]
                    ]
                ]
            ],
            'application_context' => [
                'return_url' => url('paypalpaymentsuccess'),
                'cancel_url' => url('paypalpaymentcancel')
            ]
        ];

        $response = $this->provider->createOrder($order);

        try {
            $approve_paypal_url = $response['links'][1]['href'];
            return Redirect::to($approve_paypal_url);
        } catch (\Throwable $th) {
            dd($th->getMessage(), $response);
        }
    }

    public function cancel(Request $request)
    {
        dd('payment cancled');
    }

    public function success(Request $request)
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
        return redirect()->route('success')->with('paymentsuccess','Your payment is completed');
    }
}
