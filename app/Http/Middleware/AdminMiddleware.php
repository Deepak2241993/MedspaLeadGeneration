<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() ) {
            /** @var App\Model\User */
            $user = Auth::user();
            if($user->hasRole(['Super Admin'])) {

                return redirect()->route('home')->with('error', 'You do not have access to this page.');
            }
        }
        return $next($request);
    }
}
