<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class ManagePicture extends Component
{
    public $product;
    public $images;


    public function mount(Product $product)
    {
        $this->product = $product;
        $this->images = $product->images;
    }

    public function removePic($index)
    {
        $filename = $this->images[$index];
        // delete the file from storage
        Storage::disk('public')->delete($filename);
        //unset image from array
        unset($this->images[$index]);
        $this->images = array_values($this->images);
        $this->product->update(['images' => $this->images]);
        $product = Product::findOrFail($this->product->id);
        $this->product= $product;
        $this->images = $product->images;
    }

    public function render()
    {
        return view('livewire.manage-picture');
    }
}
