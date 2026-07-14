<?php

namespace App\Http\Controllers;

use App\Http\Requests\IdeaRequest;
use App\Http\Requests\StoreIdeaRequest;
use App\Models\Idea;
use App\Notifications\IdeaPublished;
use Illuminate\Support\Facades\Gate;
use App\Enums\IdeaStatus;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        return view('ideas.index', [
            'ideas' => $user->ideas()
                ->when(
                    in_array($request->query('status'), IdeaStatus::values(), true),
                    fn($query) => $query->where('status', $request->query('status'))
                )
                ->latest()
                ->get(),
            'statuses' => IdeaStatus::cases(),
            'statusCounts' => Idea::statusCounts($user),
            'currentStatus' => in_array($request->query('status'), IdeaStatus::values(), true)
                ? $request->query('status')
                : null,
        ]);
    }

    public function create()
    {
        return view('ideas.create');
    }

    public function store(StoreIdeaRequest $request)
    {
        $idea = $request->user()
            ->ideas()
            ->create($request->safe()->except('steps'));

        $steps = $request->safe()
            ->collect('steps')
            ->filter()
            ->map(fn(string $step) => [
                'description' => $step,
            ])
            ->values();

        if ($steps->isNotEmpty()) {
            $idea->steps()->createMany($steps->all());
        }

        return to_route('ideas.index')
            ->with('success', 'La idea fue creada correctamente.');
    }

    public function show(Idea $idea)
    {
        $idea->load('steps');

        return view('ideas.show', [
            'idea' => $idea,
        ]);
    }

    public function edit(Idea $idea)
    {
        Gate::authorize('update', $idea);

        return view('ideas.edit', [
            'idea' => $idea,
        ]);
    }

    public function update(IdeaRequest $request, Idea $idea)
    {
        Gate::authorize('update', $idea);

        $validated = $request->validated();

        $idea->update([
            'description' => $validated['description'],
        ]);

        return redirect('/ideas/' . $idea->id);
    }

    public function destroy(Idea $idea)
    {
        $idea->delete();

        return to_route('ideas.index')
            ->with('success', 'La idea fue eliminada correctamente.');
    }
}
