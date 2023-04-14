<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use Livewire\Component;

class CartDisplay extends Component
{
    public $carts;
    public $total;

    protected $listeners = ['refreshCart' => 'refreshCart'];

    public function refreshCart()
    {
        $this->mount();
    }
    
    public function mount()
    {
        $this->carts = Cart::where('user_id', auth()->id())->with('product')->get();
        $this->total = 0;
        foreach ($this->carts as $cart) {
            $this->total += $cart->quantity * $cart->product->price;
        }

    }

    public function deleteCart($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        $this->emit('refreshCart');

        $this->mount();
    }

    public function render()
    {
        return view('livewire.cart-display');
    }
}
