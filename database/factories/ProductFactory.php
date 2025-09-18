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
        return [
            'name' => $this->faker->words(3, true) . ' ' . $this->faker->randomElement(['Album', 'Lightstick', 'Hoodie', 'Photocard Set']),
            'description' => $this->faker->paragraph(3),
            'price' => $this->faker->numberBetween(50000, 1000000),
            'stock' => $this->faker->numberBetween(0, 100),
            'image' => 'https://via.placeholder.com/600x600/9370DB/FFFFFF?text=' . urlencode($this->faker->randomElement(['Album', 'Lightstick', 'Hoodie', 'Photocard'])),
        ];
    }
}