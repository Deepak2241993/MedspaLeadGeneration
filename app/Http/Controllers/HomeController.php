<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\CommonModel;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function root()
    {
        $user = Auth::user();
        $api = new CommonModel();
        // Fetch leads
         $leadsResult = $api->getAPI('lead/list/0');
        // Assuming the API returns an array
        $leadCount = is_array($leadsResult) ? count($leadsResult) : 0;
        // Log::info('Accessing root dashboard by user: ' . $user->email);
        return view('index',compact('leadCount'));
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

    public function profile(Request $request)
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
