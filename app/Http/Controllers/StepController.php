<?php

namespace App\Http\Controllers;

use App\Models\Step;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class StepController extends Controller
{
    public function update(Step $step): RedirectResponse
    {
        Gate::authorize('workWith', $step->idea);

        $step->update([
            'completed' => ! $step->completed,
        ]);

        return back();
    }
}
