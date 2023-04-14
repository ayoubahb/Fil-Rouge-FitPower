<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use Livewire\Component;

class CartIcon extends Component
{
    public $cartCount;

    protected $listeners = ['refreshCart' => 'refreshCart'];

    public function refreshCart()
    {
        $this->mount();
    }

    public function mount()
    {
        $this->cartCount = Cart::where('user_id', auth()->id())->with('product')->count();
    }
    public function render()
    {
        return view('livewire.cart-icon');
    }
}
