<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Builder;

class ColorProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::whereHas('subcategory', function(Builder $query){
            $query->where('color', true)
                    ->where('size', false);
        })->get();

        foreach ($products as $product) {
            $product->colors()->attach([
                1 => [
                    'quantity' => 15
                ], 
                2 => [
                    'quantity' => 15
                ], 
                3 => [
                    'quantity' => 15
                ], 
                4 => [
                    'quantity' => 15
                ], 
                5 => [
                    'quantity' => 15
                ], 
                6 => [
                    'quantity' => 15
                ]
            ]);
        }

    }
}
