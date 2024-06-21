<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\LeadStatus;
use App\Models\EmailTemplate;
use App\Models\LeadData;
use App\Models\Admin;
use App\Models\Visitor;




class HomeController extends Controller
{
    public function index()
    {
        $lead_status_number = LeadStatus::with('id')->count();
        $email_template_number = EmailTemplate::with('id')->count();
        $lead_data_number = LeadData::with('id')->count();
        $admin_number = Admin::with('id')->count();
        $visitor_number = Visitor::with('id')->count();
        // dd(\Auth::guard('admin')->user()->hasRole('editor'));
        return view('admin.dashboard', compact('lead_status_number', 'email_template_number', 'lead_data_number', 'admin_number','visitor_number'));
        // return view('admin.dashboard');
    }

    public function adminTest()
    {
        // Check if the user has the 'admin' role
        // if (Auth::guard('admin')->user()->hasRole('admin')) {
        //     dd('Only admin allowed');
        // }

        abort(403);
    }

    public function editorTest()
    {
        // Check if the user has the 'editor' role
        if (Auth::guard('admin')->user()->hasRole('editor')) {
            dd('Only editor allowed');
        }

        abort(403);
    }
}
