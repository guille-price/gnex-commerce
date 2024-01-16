<?php

namespace App\Livewire;

use App\Models\Size;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Gloudemans\Shoppingcart\Facades\Cart;

class AddCartItemSize extends Component
{
    public $product, $sizes;
    public $color_id = "";
    public $qty = 1;
    public $size_id = "";
    public $stockQty = 0;
    public $colors = [];

    public $options = [];

    public function mount(){
        $this->sizes = $this->product->sizes;
        $this->options['image'] = Storage::url($this->product->images->first()->url);
        $this->options['weight'] = $this->product->weight;
    }

    public function updatedSizeId($value){
        $size = Size::find($value);
        $this->colors = $size->colors;
        $this->options['size'] = $size->name;
    }

    public function updatedColorId($value){
        $size = Size::find($this->size_id);
        $color = $size->colors->find($value);
        $this->stockQty = qty_available($this->product->id, $color->id, $size->id);
        $this->options['color'] = $color->name;
    }

    public function decrement(){
        $this->qty = $this->qty - 1;
    }

    public function increment(){
        $this->qty = $this->qty + 1;
    }    

    public function addItem(){
        Cart::add(['id' => $this->product->id, 
                    'name' => $this->product->name, 
                    'qty' => $this->qty, 
                    'price' => $this->product->price, 
                    'options' => $this->options
                ]);

        $this->stockQty = qty_available($this->product->id, $this->color_id, $this->size_id);

        $this->reset('qty');

        $this->dispatch('cart-added');
    }

    public function render()
    {
        return view('livewire.add-cart-item-size');
    }
}
