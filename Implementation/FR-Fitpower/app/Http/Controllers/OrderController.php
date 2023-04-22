<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('products')->latest()->get();
        // dd($orders);
        return view('order.index', [
            'orders' => $orders,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //store info in session
        $orderData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'postal_code' => 'required|numeric',
            'phone' => 'required|numeric|min:10',
            'payment_type' => 'required',
        ]);
        $orderData['userId'] = auth()->id();

        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
        $total = 0;
        foreach ($cartItems as $cartItem) {
            $product = $cartItem->product;
            if (!$product->stock <= 0 || $product->stock < $cartItem->quantity) {
                $total += $product->price * $cartItem->quantity;
            }
        }
        if ($total == 0) {
            return back()->with('error', "Your order can't be processed");
        }

        if ($orderData['payment_type'] === 'Paypal') {
            session()->put('orderData', $orderData);
            return redirect()->route('paypal.payment');
        }

        if ($orderData['payment_type'] === 'Credit card') {
            session()->put('orderData', $orderData);
            return redirect()->route('stripe.payment');
        }

        $products = [];
        foreach ($cartItems as $cartItem) {
            $product = $cartItem->product;
            $products[$product->id] = ['quantity' => $cartItem->quantity];
            $newStockQuantity = $product->stock - $cartItem->quantity;
            $product->update(['stock' => $newStockQuantity]);
        }

        $orderData['total'] = $total;
        $orderData['payment_status'] = 'Unpaid';
        $orderData['order_status'] = 'In progress';
        $orderData['products'] = $products;

        $orderCreate = Order::create($orderData);

        $orderCreate->products()->attach($orderData['products']);

        foreach ($cartItems as $cartItem) {
            $cartItem->delete();
        }
        return redirect()->route('success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $showOrder = Order::with(['products'])->findOrFail($order->id);
        return view('order.show', [
            'order' => $showOrder,
        ]);
    }

    public function update(Order $order)
    {
        $order->update(['order_status' => 'Done']);
        return redirect()->intended()->with('success','Order confirmed');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
