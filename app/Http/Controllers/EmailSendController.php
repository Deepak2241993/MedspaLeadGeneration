<?php

namespace App\Http\Controllers;

use App\Models\EmailTemplate;
use App\Models\LeadData;
use Illuminate\Http\Request;
use App\Models\CommonModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\YourEmailTemplate;


class EmailSendController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve the comma-separated emails from the request
        $emailsString = $request->input('emails', '');

        // Convert the string into an array
        $emails = array_map('trim', explode(',', $emailsString));

        // Remove duplicate email addresses
        $uniqueEmails = array_unique($emails);

        // Fetch email templates from the API
        $api = new CommonModel();
        $emailTemplates = $api->getAPI('email_template/list');
        $emailTemplates = $emailTemplates['data'];

        // Pass the unique emails and email templates to the view
        return view('emails.index', compact('uniqueEmails', 'emailTemplates'));
    }





    public function sendEmails(Request $request)
    {
        // dd($request->all());
        // Validate the request to ensure required data is provided
        $request->validate([
            'to' => 'required|string',
            'subject' => 'required|string|max:255',
            'selectedTemplate' => 'required|string',
            'html_code' => 'required|string',
        ]);
    
        // Split email addresses by comma and trim whitespace
        $toAddresses = array_filter(array_map('trim', explode(',', $request->input('to'))));
    
        // Initialize an array to collect invalid emails
        $invalidEmails = [];
    
        // Iterate over each email address
        foreach ($toAddresses as $toAddress) {
            // Validate each email address format
            if (filter_var($toAddress, FILTER_VALIDATE_EMAIL)) {
                // Send the email using Laravel's Mail facade
                Mail::to($toAddress)->send(new YourEmailTemplate($toAddress, $request->input('subject'), $request->input('selectedTemplate'), $request->input('html_code')));
            } else {
                // Add invalid email to the array
                $invalidEmails[] = $toAddress;
            }
        }
    
        // Check if there were any invalid emails
        if (!empty($invalidEmails)) {
            // Return back with an error message
            return redirect()->back()->withErrors(['Invalid email addresses: ' . implode(', ', $invalidEmails)]);
        }
    
        // Redirect with a success message if all emails were valid
        return redirect()->route('leads.index')->with('success', 'Emails sent successfully');
    }
    
}
