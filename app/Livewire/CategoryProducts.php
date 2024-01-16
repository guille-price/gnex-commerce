<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class CategoryProducts extends Component
{
    public $category;

    public $products = [];

    //#[On('glider')]
    //public function loadPosts(){
        //$this->products = $this->category->products()->where('status', 2)->take(11)->get();

        //$this->dispatch('glider', $this->category->id)->self();
        //$this->dispatch('glider')->self();
    //}
    

    public function render()
    {        
        return view('livewire.category-products');
    }
}
