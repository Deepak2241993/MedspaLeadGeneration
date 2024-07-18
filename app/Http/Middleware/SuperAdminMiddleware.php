<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SuperAdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $userRole = Auth::user()->role;

            // Log the user's role for debugging
            Log::info('User role:', ['role' => $userRole]);

            if ($userRole === 'super_admin') {
                return $next($request);
            } else {
                // Log a message when the role does not match
                Log::warning('User does not have super admin role.', ['role' => $userRole]);
            }
        } else {
            // Log a message when no user is authenticated
            Log::warning('No authenticated user found.');
        }

        return redirect('/'); // Redirect to home or login page
    }
}
