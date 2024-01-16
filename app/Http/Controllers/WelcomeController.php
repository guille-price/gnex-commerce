<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Livewire\Component;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        $categories = Category::all();
        //$categories = Category::orderByRaw('RAND()')->take(1)->get();
        $categoryRandom = $categories->random(1);
        //dd($categories->random(1));

        //$this->dispatch('glider');

        return view('welcome', compact('categories', 'categoryRandom'));
    }
}
