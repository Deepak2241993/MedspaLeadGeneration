<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\CommonModel;
use Spatie\Permission\Models\Role;

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

    $leadsResult = $api->getAPI('lead/list/0');
    $archivedLeadsResult = $api->getAPI('lead/list/1');
    $statusesResult = $api->getAPI('leadboard/status/list');
    $emailTemplatesResult = $api->getAPI('email_template/list');

    $leadCountsByStatus = [];
    $leadCount = 0;
    $archivedLeadCount = 0;
    $emailTemplateCount = 0;

    if (is_array($leadsResult) && isset($leadsResult['data'])) {
        $leadCount = count($leadsResult['data']);
    }
    if (is_array($archivedLeadsResult) && isset($archivedLeadsResult['data'])) {
        $archivedLeadCount = count($archivedLeadsResult['data']);
    }
    if (is_array($emailTemplatesResult) && isset($emailTemplatesResult['data'])) {
        $emailTemplateCount = count($emailTemplatesResult['data']);
    }
    if (is_array($leadsResult) && isset($leadsResult['data']) && is_array($statusesResult) && isset($statusesResult['data'])) {
        foreach ($statusesResult['data'] as $status) {
            $statusId = $status['_id'];
            $leadCountsByStatus[$status['name']] = [
                'count' => 0,
                'label_color' => $status['label_color'] ?? 'default-color', // Default color if not provided
                'status_id' => $statusId, // Add the status_id here
            ];

            foreach ($leadsResult['data'] as $lead) {
                if ($lead['status_id'] === $statusId) {
                    $leadCountsByStatus[$status['name']]['count']++;
                }
            }
        }
    }

    // Log::info('Accessing root dashboard by user: ' . $user->email);

    return view('index', compact('leadCount','archivedLeadCount' ,'emailTemplateCount' ,'leadCountsByStatus'));
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

    // public function profile(Request $request)
    // {
    //     $user = Auth::user();
    //     $viewPath = $request->path();
    //     $viewPath = str_replace(['../', './'], '', $viewPath);

    //     Log::info('User: ' . $user->email . ' accessing view: ' . $viewPath);

    //     if (view()->exists($viewPath)) {
    //         return view($viewPath);
    //     }

    //     Log::info('View not found: ' . $viewPath . ', returning 404');
    //     return view('errors.404');
    // }
    public function profile()
    {
        $user = Auth::user();
        // dd($user);
        // Fetch roles with both id and name
        $roles = Role::all(['id', 'name']);
        
        // Assuming $userRoles contains an array of role IDs assigned to the user
        $userRoles = $user->roles->pluck('id')->toArray();

        return view('auth.profile', ['user' => $user, 'roles' => $roles, 'userRoles' => $userRoles]);
    }
    public function updateProfile(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'country_code' => 'nullable|string|max:15',
            'phone' => 'nullable|string|max:15',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();
        // Clean the phone number by removing spaces, parentheses, and other characters
        $cleanPhone = preg_replace('/[\s\-\(\)]+/', '', $request->input('phone'));

        // Update user information
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->country_code = $request->input('country_code');
        $user->phone = $cleanPhone;

        // Handle profile picture upload
        if ($request->hasFile('profile_pic')) {
            // Define the path where you want to store the profile picture
            $destinationPath = public_path('uploads/profile_pics');
        
            // Delete the old profile picture if it exists
            if ($user->profile_pic && file_exists($destinationPath . '/' . $user->profile_pic)) {
                unlink($destinationPath . '/' . $user->profile_pic);
            }
        
            // Generate a new filename
            $profilePicName = time() . '_' . $request->file('profile_pic')->getClientOriginalName();
        
            // Move the new profile picture to the defined path
            $request->file('profile_pic')->move($destinationPath, $profilePicName);
        
            // Update user profile picture path
            $user->profile_pic = $profilePicName;
        }        

        // Save changes
        $user->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
    public function settingView()
    {
        return view('auth.settings');
    }
    public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|confirmed|min:8',
    ]);

    $user = Auth::user();

    // Check if the current password matches
    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'Current password is incorrect.']);
    }

    // Update the user's password
    $user->password = Hash::make($request->new_password);
    $user->save();

    return redirect()->route('settings')->with('status', 'Password updated successfully.');
}
    
}
