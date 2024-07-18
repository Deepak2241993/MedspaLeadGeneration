<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SalesTeamController extends Controller
{
    public function dashboard()
    {
        Log::info('Super Admin Dashboard accessed');
        return view('sales-team.dashboard');
    }
}
