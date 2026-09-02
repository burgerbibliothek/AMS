<?php

namespace Database\Factories;

use App\Models\Minter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Naan>
 */
class NaanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'naan' => fake()->unique()->numerify('#####'),
            'nma' => 'https://example.org/',
            'description' => fake()->company(),
            'shoulders' => null,
            'minter_id' => Minter::factory(),
            'spt' => false,
        ];
    }

    /**
     * Indicate that the NAAN has suffix passthrough enabled.
     */
    public function withSuffixPassthrough(): static
    {
        return $this->state(fn (array $attributes) => [
            'spt' => true,
        ]);
    }

    /**
     * Indicate that the NAAN has no assigned minter.
     */
    public function withoutMinter(): static
    {
        return $this->state(fn (array $attributes) => [
            'minter_id' => null,
        ]);
    }

    /**
     * Attach a set of shoulders to the NAAN.
     *
     * @param  array<int, array{shoulder: string, description: string}>  $shoulders
     */
    public function withShoulders(array $shoulders): static
    {
        return $this->state(fn (array $attributes) => [
            'shoulders' => $shoulders,
        ]);
    }
}
