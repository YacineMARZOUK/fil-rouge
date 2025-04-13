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
    
    public function index(Request $request)
    {
        $users = User::where('role', 'user')->get();
    
        $query = UserGoal::whereHas('user', function ($q) {
            $q->where('role', 'client');
        })->with('user');
    
        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }
    
        if ($request->filled('filters.user_id')) {
            $query->where('user_id', $request->input('filters.user_id'));
        }
    
        if ($request->filled('filters.objectif_principal')) {
            $query->where('objectif_principal', $request->input('filters.objectif_principal'));
        }
    
        $userGoals = $query->paginate(10);
    
        return view('coach.clients.index', compact('users', 'userGoals'));
    }
    

}