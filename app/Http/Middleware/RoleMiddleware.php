<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            Log::info('User not authenticated, redirecting to login');
            return redirect('/login');
        }

        $user = Auth::user();
        $userRoles = $user->getRoleNames();
        $userInfo = 'User ID: ' . $user->id . ', Email: ' . $user->email;

        Log::info('Authenticated user info: ' . $userInfo);
        Log::info('User roles: ' . json_encode($userRoles));

        if (!$user->hasRole($role)) {
            Log::info('User does not have role: ' . $role . ', redirecting to home');
            return redirect('/home');
        }

        Log::info('User has role: ' . $role . ', proceeding to next middleware');
        return $next($request);
    }
}
