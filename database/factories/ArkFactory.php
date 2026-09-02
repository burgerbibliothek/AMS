<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ark>
 */
class ArkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ark' => 'ark:99999/'.fake()->unique()->regexify('[bcdfghjkmnpqrstvwxz0-9]{8}'),
            'uri' => fake()->url(),
            'status_id' => null,
            'metadata' => null,
        ];
    }

    /**
     * Attach the ARK to a specific NAAN string (keeps the random blade).
     */
    public function forNaan(string $naan): static
    {
        return $this->state(fn (array $attributes) => [
            'ark' => "ark:{$naan}/".fake()->unique()->regexify('[bcdfghjkmnpqrstvwxz0-9]{8}'),
        ]);
    }
}
