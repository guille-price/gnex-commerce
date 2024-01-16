<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->sentence(2);

        $subcategory = Subcategory::all()->random();
        $category = $subcategory->category;

        $brand = $category->brands->random();

        if($subcategory->color){
            $quantity = null;
        }else{
            $quantity = 15;
        }
        
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description_es' => $this->faker->text(),
            'price' => $this->faker->randomElement([19.99, 49.99, 99.99]),
            'length' => $this->faker->randomElement([5.00, 7.00, 10.00, 12.00, 15.00]),
            'width' => $this->faker->randomElement([5.00, 7.00, 10.00, 12.00, 15.00]),
            'height' => $this->faker->randomElement([5.00, 7.00, 10.00, 12.00, 15.00]),
            'weight' => $this->faker->randomElement([1.00, 1.50, 2.00, 2.50, 3.00, 3.50, 4.00, 4.50, 5.00, 5.50]),
            'subcategory_id' => $subcategory->id,
            'brand_id' => $brand->id,
            'quantity'=> $quantity,
            'status' => 2
        ];
    }
}
