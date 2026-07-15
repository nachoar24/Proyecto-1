<?php

namespace App\Models;

use App\Enums\IdeaStatus;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Idea extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $attributes = [
        'links' => '[]',
        'status' => 'pending',
    ];

    protected function casts(): array
    {
        return [
            'links' => AsArrayObject::class,
            'status' => IdeaStatus::class,
        ];
    }

    protected function formattedDescription(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes): string => Str::markdown(
                $attributes['description'] ?? '',
                [
                    'html_input' => 'strip',
                    'allow_unsafe_links' => false,
                ]
            ),
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function steps(): HasMany
    {
        return $this->hasMany(Step::class);
    }

    public static function statusCounts(User $user): Collection
    {
        $counts = $user->ideas()
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        return collect(IdeaStatus::cases())
            ->mapWithKeys(fn (IdeaStatus $status) => [
                $status->value => $counts->get($status->value, 0),
            ])
            ->put('all', $user->ideas()->count());
    }
}
