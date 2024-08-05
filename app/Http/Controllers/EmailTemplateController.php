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
}
