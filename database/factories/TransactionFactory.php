<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::query()->inRandomOrder()->first() ?? Product::factory()->create();
        $qty = fake()->numberBetween(1, 3);

        return [
            'product_id' => $product->id,
            'qty' => $qty,
            'total_price' => $qty * $product->price,
            'status' => fake()->randomElement(['pending', 'paid', 'cancelled']),
        ];
    }
}
