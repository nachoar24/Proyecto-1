<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function index()
    {
        $ideas = Idea::latest()->get();

        return view('ideas.index', [
            'ideas' => $ideas,
        ]);
    }

    public function create()
    {
        return view('ideas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => ['required', 'min:10'],
        ], [
            'description.required' => 'La descripción es obligatoria.',
            'description.min' => 'La descripción debe tener al menos :min caracteres.',
        ]);

        Idea::create([
            'description' => $validated['description'],
            'state' => 'pending',
        ]);

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
        return view('ideas.edit', [
            'idea' => $idea,
        ]);
    }

    public function update(Request $request, Idea $idea)
    {
        $validated = $request->validate([
            'description' => ['required', 'min:10'],
        ], [
            'description.required' => 'La descripción es obligatoria.',
            'description.min' => 'La descripción debe tener al menos :min caracteres.',
        ]);

        $idea->update([
            'description' => $validated['description'],
        ]);

        return redirect('/ideas/' . $idea->id);
    }

    public function destroy(Idea $idea)
    {
        $idea->delete();

        return redirect('/ideas');
    }
}