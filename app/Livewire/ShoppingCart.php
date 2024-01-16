<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Gloudemans\Shoppingcart\Facades\Cart;

class ShoppingCart extends Component
{
    protected $listeners = ['render'];

    public function destroy(){
        Cart::destroy();

        $this->dispatch('cart-deleted');
    }

    public function delete($rowID){
        Cart::remove($rowID);
        $this->dispatch('cart-deleted');
        $this->dispatch('render')->self();
    }

    //#[On('dropdown-cart')]
    public function render()
    {
        return view('livewire.shopping-cart');
    }
}
