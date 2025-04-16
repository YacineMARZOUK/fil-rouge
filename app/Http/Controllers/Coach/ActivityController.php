<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Program;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:coach']);
    }

    public function index()
    {
        $activities = Activity::where('coach_id', Auth::id())
            ->with(['program', 'participants'])
            ->latest()
            ->paginate(10);

        return view('coach.activities.index', compact('activities'));
    }

    public function create()
    {
        $programs = Program::where('coach_id', Auth::id())->get();
        $users = User::where('role', 'client')->get();
        return view('coach.activities.create', compact('programs', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'program_id' => 'nullable|exists:programs,id',
            'date' => 'required|date|after:now',
            'duration' => 'required|integer|min:15',
            'user_id' => 'required|exists:users,id'
        ]);

        $activity = new Activity($validated);
        $activity->coach_id = Auth::id();
        $activity->save();

        return redirect()
            ->route('coach.activities.index')
            ->with('success', 'L\'activité a été créée avec succès.');
    }

    public function show(Activity $activity)
    {
        $this->authorize('view', $activity);
        return view('coach.activities.show', compact('activity'));
    }

    public function edit(Activity $activity)
    {
        $this->authorize('update', $activity);
        $programs = Program::where('coach_id', Auth::id())->get();
        return view('coach.activities.edit', compact('activity', 'programs'));
    }

    public function update(Request $request, Activity $activity)
    {
        $this->authorize('update', $activity);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date|after:now',
            'duration' => 'required|integer|min:15',
            'location' => 'required|string|max:255',
            'max_participants' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'program_id' => 'nullable|exists:programs,id'
        ]);

        $activity->update($validated);

        return redirect()
            ->route('coach.activities.index')
            ->with('success', 'L\'activité a été mise à jour avec succès.');
    }

    public function destroy(Activity $activity)
    {
        $this->authorize('delete', $activity);
        $activity->delete();

        return redirect()
            ->route('coach.activities.index')
            ->with('success', 'L\'activité a été supprimée avec succès.');
    }
} 