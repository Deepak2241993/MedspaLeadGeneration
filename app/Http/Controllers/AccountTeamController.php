<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AccountTeamController extends Controller
{
    public function dashboard()
    {
        Log::info('Super Admin Dashboard accessed');
        return view('account-team.dashboard');
    }
}
