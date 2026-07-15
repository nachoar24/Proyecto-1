<?php

namespace App\Actions;

use App\Models\Idea;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class UpdateIdea
{
    public function handle(array $attributes, Idea $idea): Idea
    {
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

        return DB::transaction(function () use ($attributes, $data, $idea) {
            $idea->update($data);

            $idea->steps()->delete();

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

            return $idea->refresh()->load('steps');
        });
    }
}