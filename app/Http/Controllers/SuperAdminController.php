<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\CommonModel;

class SuperAdminController extends Controller
{
    public function dashboard()
    {
        $api = new CommonModel();
        // Fetch leads
         $leadsResult = $api->getAPI('lead/list/0');
        // Assuming the API returns an array
        $leadCount = is_array($leadsResult) ? count($leadsResult) : 0;
        Log::info('Super Admin Dashboard accessed');
        return view('super-admin.dashboard',compact('leadCount'));
    }
}
