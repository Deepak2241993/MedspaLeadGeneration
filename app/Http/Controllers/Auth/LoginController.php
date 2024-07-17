<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    protected function authenticated(Request $request, $user)
    {
        Log::info('Authenticated user: ' . $user->email);
        if ($user->hasRole('super-admin')) {
            Log::info('Redirecting super-admin to their dashboard');
            return redirect()->route('super-admin.dashboard');
        } elseif ($user->hasRole('sales-team')) {
            Log::info('Redirecting sales-team to their dashboard');
            return redirect()->route('sales-team.dashboard');
        } elseif ($user->hasRole('account-team')) {
            Log::info('Redirecting account-team to their dashboard');
            return redirect()->route('account-team.dashboard');
        }

        // return redirect('/home');
    }
}
