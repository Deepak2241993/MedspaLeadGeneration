<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function root()
    {
        $user = Auth::user();
        Log::info('Accessing root dashboard by user: ' . $user->email);
        return view('index');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $viewPath = $request->path();
        $viewPath = str_replace(['../', './'], '', $viewPath);

        Log::info('User: ' . $user->email . ' accessing view: ' . $viewPath);

        if (view()->exists($viewPath)) {
            return view($viewPath);
        }

        Log::info('View not found: ' . $viewPath . ', returning 404');
        return view('errors.404');
    }
}
