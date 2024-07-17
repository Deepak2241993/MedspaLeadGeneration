<?php

namespace App\Http\Middleware;

use Closure;
<<<<<<< HEAD
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
=======
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->role == $role) {
            return $next($request);
        }

        return redirect('/');
>>>>>>> 85527fdbbbbec6cf0382eb425459fc2e187c98ec
    }
}
