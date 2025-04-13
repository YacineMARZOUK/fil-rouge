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
        
        // Statistiques de base
        $stats = [
            'total_clients' => User::where('role', 'user')->count(),
            'total_programs' => Program::where('coach_id', $coach->id)->count(),
            'total_activities' => Activity::where('coach_id', $coach->id)->count(),
        ];

        // Programmes récents
        $recent_programs = Program::where('coach_id', $coach->id)
                                ->latest()
                                ->take(5)
                                ->get();

        // Objectifs utilisateurs récents
        $recent_goals = UserGoal::whereHas('user', function($query) {
                            $query->where('role', 'user');
                        })
                        ->latest()
                        ->take(5)
                        ->get();

        $clients = User::where('role', 'user')->get();
        
                        

        return view('coach.dashboard', data: compact('stats', 'recent_programs', 'recent_goals', 'clients'));
    }
} 