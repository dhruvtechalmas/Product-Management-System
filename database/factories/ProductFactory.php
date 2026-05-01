<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'sku' => fake()->unique()->bothify('SKU###'),
            'category_id' => \App\Models\Category::inRandomOrder()->first()->id,
            'price' => fake()->numberBetween(100, 1000),
            'quantity' => fake()->numberBetween(1, 50),
            'description' => fake()->sentence(),
            'status' => 1,
        ];
    }
}
