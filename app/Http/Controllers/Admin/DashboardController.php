<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Program;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index()
    {
        $stats = [
            'total_users' => User::where('role', 'client')->count(),
            'total_coaches' => User::where('role', 'coach')->count(),
            'total_programs' => Program::count(),
            'total_products' => Product::count()
        ];

        return view('admin.dashboard', compact('stats'));
    }
} 