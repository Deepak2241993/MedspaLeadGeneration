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





    // public function sendEmails(Request $request)
    // {
    //     // dd($request->all());
    //     // Validate the request to ensure required data is provided
    //     $request->validate([
    //         'to' => 'required|string',
    //         'subject' => 'required|string|max:255',
    //         'selectedTemplate' => 'required|string',
    //         'html_code' => 'required|string',
    //     ]);
    
    //     // Split email addresses by comma and trim whitespace
    //     $toAddresses = array_filter(array_map('trim', explode(',', $request->input('to'))));
    
    //     // Initialize an array to collect invalid emails
    //     $invalidEmails = [];
    
    //     // Iterate over each email address
    //     foreach ($toAddresses as $toAddress) {
    //         // Validate each email address format
    //         if (filter_var($toAddress, FILTER_VALIDATE_EMAIL)) {
    //             // Send the email using Laravel's Mail facade
    //             Mail::to($toAddress)->send(new YourEmailTemplate($toAddress, $request->input('subject'), $request->input('selectedTemplate'), $request->input('html_code')));
    //         } else {
    //             // Add invalid email to the array
    //             $invalidEmails[] = $toAddress;
    //         }
    //     }
    
    //     // Check if there were any invalid emails
    //     if (!empty($invalidEmails)) {
    //         // Return back with an error message
    //         return redirect()->back()->withErrors(['Invalid email addresses: ' . implode(', ', $invalidEmails)]);
    //     }
    
    //     // Redirect with a success message if all emails were valid
    //     return redirect()->route('leads.index')->with('success', 'Emails sent successfully');
    // }
    public function sendEmails(Request $request)
    {
        // Validate the request to ensure required data is provided
        $request->validate([
            'to' => 'required|string',
            'subject' => 'required|string|max:255',
            'html_code' => 'required|string',
        ]);

        // Split email addresses by comma and trim whitespace
        $toAddresses = array_filter(array_map('trim', explode(',', $request->input('to'))));

        // Initialize arrays to collect invalid and failed emails
        $invalidEmails = [];
        $failedEmails = [];
        $successfulEmails = [];

        // Iterate over each email address
        foreach ($toAddresses as $toAddress) {
            // Validate each email address format
            if (filter_var($toAddress, FILTER_VALIDATE_EMAIL)) {
                try {
                    // Send the email using Laravel's Mail facade
                    Mail::to($toAddress)->send(new YourEmailTemplate($toAddress, $request->input('subject'), $request->input('html_code')));
                    $successfulEmails[] = $toAddress;
                } catch (\Exception $e) {
                    // Log the error if email sending fails
                    $failedEmails[] = $toAddress;
                    Log::error('Error sending email to ' . $toAddress . ': ' . $e->getMessage());
                    $invalidEmails[] = $toAddress . ' (sending failed)';
                }
            } else {
                // Add invalid email to the array
                $invalidEmails[] = $toAddress . ' (invalid format)';
            }
        }

        // Prepare response data
        $response = [
            'status' => empty($invalidEmails) && empty($failedEmails) ? 'success' : 'error',
            'message' => empty($invalidEmails) && empty($failedEmails) ? 'Emails sent successfully' : 'Some emails could not be sent.',
            'successful_emails' => $successfulEmails,
            'invalid_emails' => $invalidEmails,
            'failed_emails' => $failedEmails,
            'redirect_url' => route('leads.index')
        ];

        // Return a JSON response
        return response()->json($response);
    }
    
}
