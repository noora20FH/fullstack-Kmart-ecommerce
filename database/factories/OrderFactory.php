<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Pastikan ada user di database, jika tidak, buat satu
        if (User::count() == 0) {
            User::factory()->create();
        }

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'total_amount' => $this->faker->numberBetween(100000, 5000000),
            'status' => $this->faker->randomElement(['pending', 'completed', 'shipped', 'canceled']),
        ];
    }
}