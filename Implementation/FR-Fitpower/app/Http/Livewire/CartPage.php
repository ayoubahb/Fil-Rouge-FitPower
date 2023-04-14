<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use Livewire\Component;

class CartPage extends Component
{
    public $quantities = [];
    public $carts;
    public $total;

    protected $listeners = ['refreshCart' => 'refreshCart'];

    public function refreshCart()
    {
        $this->mount();
    }

    public function mount()
    {
        // Initialize quantities with the current quantities in the database
        $this->carts = Cart::where('user_id', auth()->id())->with('product')->get();
        $this->total = 0;
        foreach ($this->carts as $cart) {
            $this->quantities[$cart->id] = $cart->quantity;

            $this->total += $cart->quantity * $cart->product->price;
        }
    }

    public function updateCart()
    {

        foreach ($this->quantities as $cartId => $quantity) {
            $cart = Cart::findOrFail($cartId);
            if ($quantity <= 0 || $quantity == '') {
                $cart->delete();
            } else {
                $cart->quantity = $quantity;
                $cart->save();
            }

            session()->flash('message', 'Cart updated.');
            $this->emit('refreshCart');
        }
        $this->mount();
    }
    public function deleteCart($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        $this->emit('refreshCart');

        $this->mount();
        session()->flash('message', 'Product deleted from your cart.');
    }
    public function render()
    {
        return view('livewire.cart-page');
    }
}
