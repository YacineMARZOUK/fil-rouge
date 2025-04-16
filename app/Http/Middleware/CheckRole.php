<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role !== $role) {
            if (Auth::user()->role === 'coach') {
                return redirect()->route('coach.dashboard');
            } else {
                return redirect()->route('shop');
            }
        }

        return $next($request);
    }
} 