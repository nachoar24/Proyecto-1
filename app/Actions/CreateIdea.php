<?php

namespace App\Actions;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Support\Facades\DB;

class CreateIdea
{
    public function __construct(
        #[CurrentUser]
        protected User $user,
    ) {}

    public function handle(array $attributes): Idea
    {
        return DB::transaction(function () use ($attributes) {
            $data = collect($attributes)
                ->only(['title', 'description', 'status', 'links'])
                ->toArray();

            if ($attributes['image'] ?? false) {
                $data['image_path'] = $attributes['image']->store('ideas', 'public');
            }

            $idea = $this->user
                ->ideas()
                ->create($data);

            $steps = collect($attributes['steps'] ?? [])
                ->filter()
                ->map(fn (string $step) => [
                    'description' => $step,
                ])
                ->values();

            if ($steps->isNotEmpty()) {
                $idea->steps()->createMany($steps->all());
            }

            return $idea;
        });
    }
}
