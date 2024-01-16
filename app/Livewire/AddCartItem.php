<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Gloudemans\Shoppingcart\Facades\Cart;

class AddCartItem extends Component
{
    public $product, $stockQty, $image;
    public $qty = 1;

    public $options = [
        'color_id' => null,
        'size_id' => null
    ];

    public function mount(){
        $this->stockQty = qty_available($this->product->id);
        //$this->image = Storage::url($this->product->images->first()->url);
        $this->options['image'] = Storage::url($this->product->images->first()->url);
        $this->options['weight'] = $this->product->weight;

        //dd($this->image);
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

        $this->stockQty = qty_available($this->product->id);

        $this->reset('qty');

        $this->dispatch('cart-added');
    }

    public function render()
    {
        return view('livewire.add-cart-item');
    }
}
