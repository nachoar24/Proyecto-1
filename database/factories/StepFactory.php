<?php

namespace Database\Factories;

use App\Models\Idea;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Step>
 */
class StepFactory extends Factory
{
    public function definition(): array
    {
        return [
            'idea_id' => Idea::factory(),
            'description' => fake()->sentence(),
            'completed' => false,
        ];
    }
}