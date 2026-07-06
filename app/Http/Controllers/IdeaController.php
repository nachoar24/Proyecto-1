<?php

namespace App\Http\Controllers;

use App\Http\Requests\IdeaRequest;
use App\Models\Idea;
use App\Notifications\IdeaPublished;
use Illuminate\Support\Facades\Gate;
use App\Enums\IdeaStatus;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function index(Request $request)
    {
    $status = $request->query('status');

    if (! in_array($status, IdeaStatus::values(), true)) {
        $status = null;
    }

    $user = $request->user();

    return view('ideas.index', [
        'ideas' => $user->ideas()
            ->when($status, fn ($query) => $query->where('status', $status))
            ->latest()
            ->get(),
        'statuses' => IdeaStatus::cases(),
        'statusCounts' => Idea::statusCounts($user),
        'currentStatus' => $status,
    ]);
    }

    public function create()
    {
        return view('ideas.create');
    }

    public function store(IdeaRequest $request)
    {
        $validated = $request->validated();

        $idea = auth()->user()->ideas()->create([
            'description' => $validated['description'],
            'state' => 'pending',
        ]);

        auth()->user()->notify(new IdeaPublished($idea));

        return redirect('/ideas');
    }

    public function show(Idea $idea)
    {
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

        return redirect('/ideas/'.$idea->id);
    }

    public function destroy(Idea $idea)
    {
    $idea->delete();

    return to_route('ideas.index')
        ->with('success', 'La idea fue eliminada correctamente.');
    }
}
