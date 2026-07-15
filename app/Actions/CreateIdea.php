<?php

namespace App\Actions;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Http\UploadedFile;
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
                ->only([
                    'title',
                    'description',
                    'status',
                    'links',
                ])
                ->toArray();

            if (($attributes['image'] ?? null) instanceof UploadedFile) {
                $data['image_path'] = $attributes['image']
                    ->store('ideas', 'public');
            }

            $idea = $this->user
                ->ideas()
                ->create($data);

            $steps = collect($attributes['steps'] ?? [])
                ->filter(
                    fn (array $step) => filled(
                        $step['description'] ?? null
                    )
                )
                ->map(fn (array $step) => [
                    'description' => $step['description'],
                    'completed' => (bool) ($step['completed'] ?? false),
                ])
                ->values();

            if ($steps->isNotEmpty()) {
                $idea->steps()->createMany($steps->all());
            }

            return $idea;
        });
    }
}