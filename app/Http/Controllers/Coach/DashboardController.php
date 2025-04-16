<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Activity;
use App\Models\UserGoal;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:coach']);
    }

    public function index()
    {
        $coach = Auth::user();
        
        $stats = [
            'total_clients' => User::where('role', 'client')->count(),
            'total_programs' => Program::where('coach_id', $coach->id)->count(),
            'total_activities' => Activity::where('coach_id', $coach->id)->count(),
            'upcoming_activities' => Activity::where('coach_id', $coach->id)
                ->where('date', '>=', now())
                ->orderBy('date')
                ->take(5)
                ->get()
        ];

        // Programmes récents
        $recent_programs = Program::where('coach_id', $coach->id)
                                ->with('user')
                                ->latest()
                                ->take(5)
                                ->get();

       

        // Objectifs utilisateurs récents
        $recent_goals = UserGoal::whereHas('program', function($query) use ($coach) {
                                    $query->where('coach_id', $coach->id);
                                })
                                ->with(['user', 'program'])
                                ->latest()
                                ->take(5)
                                ->get();

        return view('coach.dashboard', compact(
            'stats',
            'recent_programs',
            
            'recent_goals'
        ));
    }
} 