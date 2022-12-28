<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Travel;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Step>
 */
class StepFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'type' => fake()->randomElement(['plane', 'train', 'bus']),
            'seat' => fake()->word(),
            'transport_number' => fake()->word(),
            'departure_date' => now(),
            'arrival_date' => now('+1 hour'),
            'departure' => fake()->word(),
            'arrival' => fake()->word(),
            'travel_id' => Travel::all()->random(),
        ];
    }
}
