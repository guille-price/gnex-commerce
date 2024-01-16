<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Gloudemans\Shoppingcart\Facades\Cart;

class AddCartItemColor extends Component
{
    public $product, $colors, $image;
    public $color_id ="";

    public $qty = 1;
    public $stockQty = 0;

    public $options = [
        'size_id' => null
    ];

    public function mount(){
        $this->colors = $this->product->colors;

        //$this->stockQty = $this->product->quantity;
        //$this->image = Storage::url($this->product->images->first()->url);
        $this->options['image'] = Storage::url($this->product->images->first()->url);
        $this->options['weight'] = $this->product->weight;
    }

    public function updatedColorId($value){
        $color = $this->product->colors->find($value);
        $this->stockQty = qty_available($this->product->id, $color->id);
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

        $this->stockQty = qty_available($this->product->id, $this->color_id);

        $this->reset('qty');

        $this->dispatch('cart-added');
    }

    public function render()
    {
        return view('livewire.add-cart-item-color');
    }

}
