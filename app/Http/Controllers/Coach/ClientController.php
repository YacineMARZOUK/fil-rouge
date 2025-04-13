<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserGoal;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:coach']);
    }
    
    public function index()
{
    // Récupérer les utilisateurs avec le rôle 'user' et leurs objectifs
    $users = User::where('role', 'user')
             ->with('goals') // Correct !
             ->get();
             $userGoals = UserGoal::whereHas('user', function($query) {
                $query->where('role', 'client');
            })
            ->with('user')
            ->paginate(10);
                
    return view('coach.clients.index', compact('users' , 'userGoals'));
}
}