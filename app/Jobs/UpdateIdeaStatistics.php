<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class UpdateIdeaStatistics implements ShouldQueue
{
    use Queueable;

    public function handle(): void
    {
        logger('UpdateIdeaStatistics job processed successfully.');
    }
}
