<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class Search extends Component
{
    public $search;
    public $products=[];

    public $open = false;

    public function updatedSearch($value){
        if ($value) {
            $this->open = true;
        }else{
            $this->open = false;
        }
    }

    public function render()
    {
        if ($this->search) {
            $this->products = Product::where('name', 'LIKE' ,'%' . $this->search . '%')
                                ->where('status', 2)
                                ->take(10)
                                ->get();
        } else {
            $this->products = Product::where('status', 2)
                                    ->take(3)
                                    ->get();
        }

        return view('livewire.search');
    }
}
