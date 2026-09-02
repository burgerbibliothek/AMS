<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Minter>
 */
class MinterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word().' minter',
            'length' => 10,
            'xdigits' => '0123456789bcdfghjkmnpqrstvwxz',
            'ncda' => true,
        ];
    }
}
