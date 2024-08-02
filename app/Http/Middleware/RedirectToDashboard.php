<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RedirectToDashboard
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            Log::info('Authenticated user: ' . $user->email);

            if ($user->hasRole('super-admin')) {
                Log::info('Redirecting super-admin to their dashboard');
                return redirect()->route('super-admin.dashboard');
            } elseif ($user->hasRole('sales-team')) {
                Log::info('Redirecting sales team to their dashboard');
                return redirect()->route('sales-team.dashboard');
            } elseif ($user->hasRole('account-team')) {
                Log::info('Redirecting account team to their dashboard');
                return redirect()->route('account-team.dashboard');
            } else {
                Log::info('User has no specific role, redirecting to home');
                return redirect('/');
            }
        }

        return $next($request);
    }
}
