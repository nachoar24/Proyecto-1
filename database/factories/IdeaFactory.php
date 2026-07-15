<?php

namespace Database\Factories;

use App\Enums\IdeaStatus;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Idea>
 */
class IdeaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'links' => [
                'https://laravel.com',
            ],
            'status' => IdeaStatus::Pending,
            'state' => 'pending',
            'image_path' => null,
        ];
    }
}
