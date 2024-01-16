<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class DropdownCart extends Component
{
    protected $listeners = ['render'];

    #[On('cart-added')]
    #[On('cart-deleted')]
    public function render()
    {
        return view('livewire.dropdown-cart');
    }
}
