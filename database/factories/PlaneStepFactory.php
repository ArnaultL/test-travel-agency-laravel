<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Step;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PlaneStep>
 */
class PlaneStepFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'bagage_drop' => fake()->word(),
            'gateway' => fake()->word(),
            'step_id' => Step::all()->random(),
        ];
    }
}
