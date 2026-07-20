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
        $categories = ['Chairs', 'Tables', 'Sofas', 'Beds', 'Cabinets'];

        return [
            'name' => fake()->words(3, true),
            'sku' => strtoupper(fake()->bothify('FRN-####')),
            'category' => fake()->randomElement($categories),
            'unit_price' => fake()->randomFloat(2, 500, 15000),
            'quantity_on_hand' => fake()->numberBetween(0, 100),
            'reorder_level' => fake()->numberBetween(5, 20),
            'status' => 'active',
        ];
    }
}

