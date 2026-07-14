<?php

namespace App\Http\Controllers;

use App\Actions\CreateIdea;
use App\Enums\IdeaStatus;
use App\Http\Requests\IdeaRequest;
use App\Http\Requests\StoreIdeaRequest;
use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class IdeaController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        return view('ideas.index', [
            'ideas' => $user->ideas()
                ->when(
                    in_array($request->query('status'), IdeaStatus::values(), true),
                    fn ($query) => $query->where('status', $request->query('status'))
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

    public function store(StoreIdeaRequest $request, CreateIdea $createIdea)
    {
        $createIdea->handle($request->safe()->all());

        return to_route('ideas.index')
            ->with('success', 'La idea fue creada correctamente.');
    }

    public function show(Idea $idea)
    {
        Gate::authorize('workWith', $idea);

        $idea->load('steps');

        return view('ideas.show', [
            'idea' => $idea,
        ]);
    }

    public function edit(Idea $idea)
    {
        Gate::authorize('workWith', $idea);

        return view('ideas.edit', [
            'idea' => $idea,
        ]);
    }

    public function update(IdeaRequest $request, Idea $idea)
    {
        Gate::authorize('workWith', $idea);

        $validated = $request->validated();

        $idea->update([
            'description' => $validated['description'],
        ]);

        return redirect('/ideas/'.$idea->id);
    }

    public function destroy(Idea $idea)
    {
        Gate::authorize('workWith', $idea);

        $idea->delete();

        return to_route('ideas.index')
            ->with('success', 'La idea fue eliminada correctamente.');
    }
}
