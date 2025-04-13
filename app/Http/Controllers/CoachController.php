<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\UserGoal;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoachController extends Controller
{
    // Programmes
    public function indexPrograms(Request $request)
    {
        $query = Program::where('coach_id', Auth::id());

        if ($request->has('search')) {
            $query->search($request->search);
        }

        if ($request->has('filters')) {
            $query->filter($request->filters);
        }

        $sortBy = $request->input('sort_by', 'created_at');
        $sortDirection = $request->input('sort_direction', 'desc');
        $query->sort($sortBy, $sortDirection);

        $programs = $query->with(['user', 'activities'])
            ->paginate(10);

        return view('coach.programs.index', compact('programs'));
    }

    public function createProgram()
    {
        $users = User::where('role', 'client')->get();
        return view('coach.programs.create', compact('users'));
    }

    public function storeProgram(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'duration' => 'required|integer|min:1',
            'difficulty_level' => 'required|in:beginner,intermediate,advanced',
        ]);

        $program = Program::create([
            'name' => $request->name,
            'description' => $request->description,
            'coach_id' => Auth::id(),
            'user_id' => $request->user_id,
            'duration' => $request->duration,
            'difficulty_level' => $request->difficulty_level,
            'status' => 'draft'
        ]);

        return redirect()->route('coach.programs.show', $program)
            ->with('success', 'Programme créé avec succès');
    }

    public function showProgram(Program $program)
    {
        $this->authorize('view', $program);
        return view('coach.programs.show', compact('program'));
    }

    public function editProgram(Program $program)
    {
        $this->authorize('update', $program);
        $users = User::where('role', 'client')->get();
        return view('coach.programs.edit', compact('program', 'users'));
    }

    public function updateProgram(Request $request, Program $program)
    {
        $this->authorize('update', $program);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'duration' => 'required|integer|min:1',
            'difficulty_level' => 'required|in:beginner,intermediate,advanced',
            'status' => 'required|in:draft,active,completed,cancelled'
        ]);

        $program->update($request->all());

        return redirect()->route('coach.programs.show', $program)
            ->with('success', 'Programme mis à jour avec succès');
    }

    public function destroyProgram(Program $program)
    {
        $this->authorize('delete', $program);
        $program->delete();

        return redirect()->route('coach.programs.index')
            ->with('success', 'Programme supprimé avec succès');
    }

    // Activités
    public function indexActivities(Request $request)
    {
        $query = Activity::where('coach_id', Auth::id());

        if ($request->has('search')) {
            $query->search($request->search);
        }

        if ($request->has('filters')) {
            $query->filter($request->filters);
        }

        if ($request->has('start_date')) {
            $query->where('date', '>=', $request->start_date);
        }
        if ($request->has('end_date')) {
            $query->where('date', '<=', $request->end_date);
        }

        $sortBy = $request->input('sort_by', 'date');
        $sortDirection = $request->input('sort_direction', 'asc');
        $query->sort($sortBy, $sortDirection);

        $activities = $query->with(['program', 'participants'])
            ->paginate(10);

        return view('coach.activities.index', compact('activities'));
    }

    public function createActivity()
    {
        $programs = Program::where('coach_id', Auth::id())->get();
        return view('coach.activities.create', compact('programs'));
    }

    public function storeActivity(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string',
            'max_participants' => 'required|integer|min:1',
            'program_id' => 'nullable|exists:programs,id'
        ]);

        $activity = Activity::create([
            'name' => $request->name,
            'description' => $request->description,
            'date' => $request->date,
            'location' => $request->location,
            'max_participants' => $request->max_participants,
            'program_id' => $request->program_id,
            'coach_id' => Auth::id()
        ]);

        return redirect()->route('coach.activities.show', $activity)
            ->with('success', 'Activité créée avec succès');
    }

    public function showActivity(Activity $activity)
    {
        $this->authorize('view', $activity);
        return view('coach.activities.show', compact('activity'));
    }

    public function editActivity(Activity $activity)
    {
        $this->authorize('update', $activity);
        $programs = Program::where('coach_id', Auth::id())->get();
        return view('coach.activities.edit', compact('activity', 'programs'));
    }

    public function updateActivity(Request $request, Activity $activity)
    {
        $this->authorize('update', $activity);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string',
            'max_participants' => 'required|integer|min:1',
            'program_id' => 'nullable|exists:programs,id'
        ]);

        $activity->update($request->all());

        return redirect()->route('coach.activities.show', $activity)
            ->with('success', 'Activité mise à jour avec succès');
    }

    public function destroyActivity(Activity $activity)
    {
        $this->authorize('delete', $activity);
        $activity->delete();

        return redirect()->route('coach.activities.index')
            ->with('success', 'Activité supprimée avec succès');
    }

    // Objectifs utilisateur
    public function indexUserGoals(Request $request, User $user)
    {
        $query = UserGoal::where('user_id', $user->id);

        if ($request->has('search')) {
            $query->search($request->search);
        }

        if ($request->has('filters')) {
            $query->filter($request->filters);
        }

        if ($request->has('start_date')) {
            $query->where('target_date', '>=', $request->start_date);
        }
        if ($request->has('end_date')) {
            $query->where('target_date', '<=', $request->end_date);
        }

        $sortBy = $request->input('sort_by', 'target_date');
        $sortDirection = $request->input('sort_direction', 'asc');
        $query->sort($sortBy, $sortDirection);

        $goals = $query->with(['user', 'program'])
            ->paginate(10);

        return view('coach.clients.index', compact('goals', 'user'));
    }

    public function createUserGoal(User $user)
    {
        $programs = Program::where('coach_id', Auth::id())
            ->where('user_id', $user->id)
            ->get();

        return view('coach.clients.create', compact('user', 'programs'));
    }

    public function storeUserGoal(Request $request, User $user)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'target_date' => 'required|date',
            'type' => 'required|in:fitness,nutrition,lifestyle,other',
            'program_id' => 'nullable|exists:programs,id'
        ]);

        $goal = UserGoal::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'description' => $request->description,
            'target_date' => $request->target_date,
            'type' => $request->type,
            'program_id' => $request->program_id,
            'status' => 'pending',
            'progress' => 0
        ]);

        return redirect()->route('coach.clients.show', ['user' => $user, 'goal' => $goal])
            ->with('success', 'Objectif créé avec succès');
    }

    public function showUserGoal(User $user, UserGoal $goal)
    {
        $this->authorize('view', $goal);
        return view('coach.clients.show', compact('goal', 'user'));
    }

    public function editUserGoal(User $user, UserGoal $goal)
    {
        $this->authorize('update', $goal);
        $programs = Program::where('coach_id', Auth::id())
            ->where('user_id', $user->id)
            ->get();

        return view('coach.clients.edit', compact('goal', 'user', 'programs'));
    }

    public function updateUserGoal(Request $request, User $user, UserGoal $goal)
    {
        $this->authorize('update', $goal);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'target_date' => 'required|date',
            'type' => 'required|in:fitness,nutrition,lifestyle,other',
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'progress' => 'required|integer|min:0|max:100',
            'program_id' => 'nullable|exists:programs,id'
        ]);

        $goal->update($request->all());

        return redirect()->route('coach.clients.show', ['user' => $user, 'goal' => $goal])
            ->with('success', 'Objectif mis à jour avec succès');
    }

    public function destroyUserGoal(User $user, UserGoal $goal)
    {
        $this->authorize('delete', $goal);
        $goal->delete();

        return redirect()->route('coach.clients.index', $user)
            ->with('success', 'Objectif supprimé avec succès');
    }
} 