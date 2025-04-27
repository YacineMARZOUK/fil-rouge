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

    public function index(Request $request)
    {
        $query = Activity::where('coach_id', Auth::id())
            ->with('participants')
            ->latest();
    
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
    
        if ($request->filled('start_date')) {
            $query->whereDate('date', '>=', $request->start_date);
        }
        
    
        $activities = $query->paginate(10);
    
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
            'date' => 'required|date|after:now',
            'duration' => 'required|integer|min:15',
            
        ]);
    
        // Create the activity with validated fields except user_id
        $activityData = collect($validated)->except(['user_id'])->toArray();
        $activity = new Activity($activityData);
        $activity->coach_id = Auth::id();
        $activity->save();
    
        // Attach the selected user as a participant
        $activity->participants()->attach($request->user_id);
    
        return redirect()
            ->route('coach.activities.index')
            ->with('success', 'L\'activité a été créée avec succès.');
    }
    public function show(Activity $activity)
    {
         // Vérifier que l'activité appartient bien au coach connecté
      if ($activity->coach_id !== Auth::id()) {
         return redirect()
            ->route('coach.activities.index')
            ->with('error', 'Vous n\'êtes pas autorisé à voir cette activité.');
    }
    
    // Charger la relation participants pour l'affichage
    $activity->load('participants');
    
    return view('coach.activities.show', compact('activity'));
    }

    public function edit(Activity $activity)
    {
       
        $programs = Program::where('coach_id', Auth::id())->get();
        return view('coach.activities.edit', compact('activity', 'programs'));
    }

    public function update(Request $request, Activity $activity)
    {
        

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date|after:now',
            'duration' => 'required|integer|min:15',
            'program_id' => 'nullable|exists:programs,id'
        ]);

        $activity->update($validated);

        return redirect()
            ->route('coach.activities.index')
            ->with('success', 'L\'activité a été mise à jour avec succès.');
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();

        return redirect()
            ->route('coach.activities.index')
            ->with('success', 'L\'activité a été supprimée avec succès.');
    }

    public function removeParticipant(Activity $activity, User $user)
{
    // Vérifier que l'activité appartient bien au coach connecté
    if ($activity->coach_id !== Auth::id()) {
        return redirect()
            ->route('coach.activities.index')
            ->with('error', 'Vous n\'êtes pas autorisé à modifier cette activité.');
    }
    
    // Retirer le participant
    $activity->participants()->detach($user->id);
    
    return redirect()
        ->route('coach.activities.show', $activity)
        ->with('success', 'Le participant a été retiré avec succès.');
}

    
} 