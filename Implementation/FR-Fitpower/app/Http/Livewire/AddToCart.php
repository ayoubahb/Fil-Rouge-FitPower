<?php

namespace App\Http\Livewire;

use Livewire\WithProperties;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;

class AddToCart extends Component
{
    // use WithProperties;
    public $product;

    public function mount (Product $product){
        $this->product = $product;
    }

    public function addToCart()
    {
        $productExist = Cart::where('product_id', $this->product->id)->where('user_id', auth()->id())->exists();
        if ($productExist) {
            session()->flash('message', 'This product is already in your cart.');
        } else {
            Cart::create([
                'product_id' => $this->product->id,
                'user_id' => auth()->id(),
                'quantity' => 1
            ]);
            session()->flash('message', 'Product added to your cart.');
        }
        $this->emit('refreshCart');
    }

    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
