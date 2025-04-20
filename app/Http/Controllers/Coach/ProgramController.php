<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::where('coach_id', Auth::id())
                         ->latest()
                         ->paginate(10);

        return view('coach.programs.index', compact('programs'));
    }

    public function create()
    {
        return view('coach.programs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|integer|min:1',
            'difficulty' => 'required|in:facile,moyen,difficile',
            'objectif_cible' => 'required|in:perte_poids,prise_muscle,maintien,endurance'
        ]);

        $program = new Program();
        $program->name = $validated['name'];
        $program->description = $validated['description'];
        $program->duration = $validated['duration'];
        $program->difficulty = $validated['difficulty'];
        $program->objectif_cible = $validated['objectif_cible'];
        $program->coach_id = Auth::id();
        $program->status = 'active';
        $program->save();

        return redirect()
            ->route('coach.programs.index')
            ->with('success', 'Le programme a été créé avec succès.');
    }

    public function edit(Program $program)
    {
        if ($program->coach_id !== Auth::id()) {
            abort(403);
        }

        return view('coach.programs.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        if ($program->coach_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|integer|min:1',
            'difficulty' => 'required|in:facile,moyen,difficile',
            'objectif_cible' => 'required|in:perte_poids,prise_muscle,maintien,endurance',
            'status' => 'required|in:active,inactive'
        ]);

        $program->update($validated);

        return redirect()
            ->route('coach.programs.index')
            ->with('success', 'Le programme a été mis à jour avec succès.');
    }

    public function destroy(Program $program)
    {
        if ($program->coach_id !== Auth::id()) {
            abort(403);
        }

        $program->delete();

        return redirect()
            ->route('coach.programs.index')
            ->with('success', 'Le programme a été supprimé avec succès.');
    }
} 