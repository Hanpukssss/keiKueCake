<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
        $name = fake()->words(2, true);
        $images = [
            'https://images.unsplash.com/photo-1541781286675-5e86c1b4a4f4?auto=format&fit=crop&w=640&q=80',
            'https://images.unsplash.com/photo-1505250469679-203ad9ced0cb?auto=format&fit=crop&w=640&q=80',
            'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=640&q=80',
            'https://images.unsplash.com/photo-1481391032119-d89fee407e44?auto=format&fit=crop&w=640&q=80',
        ];

        return [
            'name' => ucfirst($name),
            'price' => fake()->randomFloat(2, 10000, 500000),
            'stock' => fake()->numberBetween(5, 50),
            'description' => fake()->sentence(12),
            'image' => fake()->randomElement($images),
        ];
    }
}
