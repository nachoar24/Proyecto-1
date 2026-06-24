<?php

namespace App\Http\Controllers;

use App\Http\Requests\IdeaRequest;
use App\Models\Idea;

class IdeaController extends Controller
{
    public function index()
    {
        $ideas = Idea::query()
            ->where('user_id', auth()->id())
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

        Idea::create([
            'user_id' => auth()->id(),
            'description' => $validated['description'],
            'state' => 'pending',
        ]);

        return redirect('/ideas');
    }

    public function show(Idea $idea)
    {
        $this->authorizeCurrentUserIdea($idea);

        return view('ideas.show', [
            'idea' => $idea,
        ]);
    }

    public function edit(Idea $idea)
    {
        $this->authorizeCurrentUserIdea($idea);

        return view('ideas.edit', [
            'idea' => $idea,
        ]);
    }

    public function update(IdeaRequest $request, Idea $idea)
    {
        $this->authorizeCurrentUserIdea($idea);

        $validated = $request->validated();

        $idea->update([
            'description' => $validated['description'],
        ]);

        return redirect('/ideas/' . $idea->id);
    }

    public function destroy(Idea $idea)
    {
        $this->authorizeCurrentUserIdea($idea);

        $idea->delete();

        return redirect('/ideas');
    }

    private function authorizeCurrentUserIdea(Idea $idea): void
    {
        abort_unless($idea->user_id === auth()->id(), 403);
    }
}