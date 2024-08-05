<?php

namespace App\Http\Controllers;

use App\Models\CommonModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmailTemplateController extends Controller
{
    public function index(Request $request)
    {
        $api = new CommonModel();
        $result = $api->getAPI('email_template/list');

        // Check if $result is null or not an array
        if (is_array($result) && isset($result['status'])) {
            if ($result['status'] == "success") {
                $data = $result['data'];

                // Check if data is empty
                if (empty($data)) {
                    $message = 'No data found.';
                } else {
                    $message = null; // No error message if data is found
                }

                return view('email-template.index', compact('data', 'message'));
            } else {
                // Handle the case where API call was successful but status is not "success"
                $error_message = 'Failed to retrieve leads.';
                return view('email-template.index', compact('error_message'));
            }
        } else {
            // Handle the case where $result is null or not an array (API call failed)
            $error_message = 'Failed to retrieve data from API.';
            return view('email-template.index', compact('error_message'));
        }
    }
    public function create(Request $request)
    {
        return view('email-template.create');
    }
    public function store(Request $request)
    {
        $api = new CommonModel();

        // Extract data from the request
        $title = $request->title;
        $html_code = $request->html_code;
        $status = $request->status;

        // Prepare data array to be sent to the API
        $data = [
            'title' => $title,
            'html_code' => $html_code,
            'status' => $status,
        ];

        // Convert data to JSON format
        $dataJson = json_encode($data);
        
        // Call the API to store the data
        $result = $api->postAPI('email_template/add', $dataJson);

        // Check if API call was successful
        if (isset($result['status']) && $result['status'] == 'error') {
            // Handle API error
            return back()->with('imperialheaders_success', $result['responseMessage']);
        } else {
            // API call was successful
            return back()->with('imperialheaders_success', $result['responseMessage']);
        }
    }
    public function edit($id)
    {
        $emailtemp = EmailTemplate::findOrFail($id);
        return view('email-template.edit')->with('emailtemp', $emailtemp);
    }

    public function destroy($id, CommonModel $api)
    {
        // $emailTemplate = EmailTemplate::find($id);

        $result = $api->postAPI("email_template/delete/{$id}", []);

        if ($result['status'] === 'success') {
            // Optionally, you may perform additional actions for success
            $message = 'Status updated successfully';
    
            // JSON response for success
            $jsonResponse = response()->json(['message' => $message], 200);
    
            // View response for success
            $viewResponse = view('admin.email-template.index', compact('result'));
    
            // Return both responses
            return [$jsonResponse, $viewResponse];
        } else {
            // Handle different statuses (e.g., error, not found)
            return response()->json(['error' => 'Error deleting lead'], 500);
        }

    }
}
