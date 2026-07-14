<?php

namespace App\Http\Controllers;

use App\Models\Step;
use Illuminate\Http\RedirectResponse;

class StepController extends Controller
{
    public function update(Step $step): RedirectResponse
    {
        $step->update([
            'completed' => ! $step->completed,
        ]);

        return back();
    }
}