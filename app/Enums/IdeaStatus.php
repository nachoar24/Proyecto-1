<?php

namespace App\Enums;

enum IdeaStatus: string
{
    case Pending = 'pending';
    case InProgress = 'in_progress';
    case Completed = 'completed';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Pendiente',
            self::InProgress => 'En progreso',
            self::Completed => 'Completada',
        };
    }

    public static function values(): array
    {
        return array_map(
            fn (self $status) => $status->value,
            self::cases()
        );
    }
}