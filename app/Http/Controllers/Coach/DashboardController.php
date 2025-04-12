<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Program;
use App\Models\User;
use App\Models\UserGoal;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:coach');
    }

    public function index()
    {
        // Statistiques générales
        $totalUsers = User::where('role', 'user')->count();
        $activePrograms = Program::where('status', 'active')->count();
        $upcomingActivities = Activity::where('date', '>', now())->count();
        $ongoingGoals = UserGoal::count(); // On compte tous les objectifs car il n'y a plus de statut

        // Dernières activités
        $recentActivities = Activity::with('participants')
            ->orderBy('date', 'desc')
            ->take(5)
            ->get();

        // Objectifs des utilisateurs
        $userGoals = UserGoal::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Statistiques des niveaux de difficulté
        $difficultyStats = [
            'beginner' => Program::where('difficulty_level', 'beginner')->count(),
            'intermediate' => Program::where('difficulty_level', 'intermediate')->count(),
            'advanced' => Program::where('difficulty_level', 'advanced')->count()
        ];

        // Statistiques des statuts des programmes
        $statusStats = [
            'draft' => Program::where('status', 'draft')->count(),
            'active' => Program::where('status', 'active')->count(),
            'completed' => Program::where('status', 'completed')->count(),
            'cancelled' => Program::where('status', 'cancelled')->count()
        ];

        return view('coach.dashboard', compact(
            'totalUsers',
            'activePrograms',
            'upcomingActivities',
            'ongoingGoals',
            'recentActivities',
            'userGoals',
            'difficultyStats',
            'statusStats'
        ));
    }
} 