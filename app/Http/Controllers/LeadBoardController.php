<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommonModel;
use Illuminate\Support\Facades\Log;

class LeadBoardController extends Controller
{
    public function index(Request $request)
    {
        // dd($request);
        // Instantiate CommonModel
        $api = new CommonModel();

        // Call the first API endpoint
        $result1 = $api->getAPI('leadboard/status/list');

        // Call the second API endpoint
        $result2 = $api->getAPI('lead/list/0');

        // Check if both API calls were successful
        if ($result1['status'] == "success" && $result2['status'] == "success") {
            // Extract data from both API responses
            $leadStatuses = $result1['data'];
            $leadData = $result2['data'];


            // Return the view with the extracted data
            return view('leadboard.index', compact('leadStatuses', 'leadData'));
        } else {
            // Handle the case where one or both API calls failed
            return response()->json(['error' => 'Data Not Found']);
        }
    }

    public function updateIndex(Request $request)
    {

        $api = new CommonModel();
        $status_id = $request->input('column_name');
        $task_id = $request->input('task_id');

        $data_arr = [
            'status_id' => $status_id, // Include status_id
            '_id' => $task_id          // Include _id (task_id)
        ];
        $data = json_encode($data_arr);

        $apiResult = $api->postAPI("lead/update", $data);

        // Check if the API call was successful based on the API response
        if (isset($apiResult['status'])  && $apiResult['status'] === 'success') {
            return redirect()->route('leadboard')->with('success', 'Leadboad status updated successfully');
        } else {
            // Handle the case where the API call did not return success
            $errorMessage = isset($apiResult['message']) ? $apiResult['message'] : 'Failed to update lead status via API';
            return redirect()->route('leadboard')->with('error', $errorMessage);
        }
    }
}
