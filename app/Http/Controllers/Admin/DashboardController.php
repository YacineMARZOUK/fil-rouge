<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Program;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index()
    {
        // Récupération des statistiques
        $stats = [
            'total_users' => User::count(),
            'total_clients' => User::where('role', 'client')->count(),
            'total_coaches' => User::where('role', 'coach')->count(),
            'total_products' => Product::count(),
            'total_orders' => Order::count(),
            'total_programs' => Program::count(),
            'recent_orders' => Order::with('user')
                                  ->orderBy('created_at', 'desc')
                                  ->take(5)
                                  ->get(),
            'recent_users' => User::orderBy('created_at', 'desc')
                                 ->take(5)
                                 ->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
} 