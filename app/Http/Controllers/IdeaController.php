<?php

namespace App\Http\Controllers;

use App\Http\Requests\IdeaRequest;
use App\Models\Idea;
use App\Notifications\IdeaPublished;
use Illuminate\Support\Facades\Gate;

class IdeaController extends Controller
{
    public function index()
    {
        $ideas = auth()->user()
            ->ideas()
            ->latest()
            ->get();

        return view('ideas.index', [
            'ideas' => $ideas,
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
        Gate::authorize('update', $idea);

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
        Gate::authorize('update', $idea);

        $idea->delete();

        return redirect('/ideas');
    }
}
