<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition()
    {
        return [
            'freight_payer_self' => fake()->boolean(),
            'contract_number' => fake()->numberBetween(1, 100000),
            'bl_number' => fake()->numberBetween(1, 100000)
        ];
    }
}
