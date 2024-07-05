<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommonModel;

class LeadBoardController extends Controller
{
    public function index(Request $request)
    {
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
        // Instantiate CommonModel
        $api = new CommonModel();

        // Call the first API endpoint to get leadboard status list
        $result1 = $api->getAPI('leadboard/status/list');
        $result2 = $api->getAPI('lead/update');

        dd($result2);

        // Check if the API call was successful
        if ($result1['status'] == 'success' && isset($result1['data'])) {
            // Extract lead statuses from the API response
            $leadStatuses = $result1['data'];

            // Find the lead status (board) based on the provided boardColumnId
            $board = null;
            foreach ($leadStatuses as $status) {
                if ($status['_id'] == $request->boardColumnId) {
                    $board = $status;
                    break;
                }
            }

            // Check if the board was found
            if (!$board) {
                // Handle the case where the provided boardColumnId is not found
                return Reply::error('Board not found');
            }

            $taskIds = $request->taskIds;
            $boardColumnId = $request->boardColumnId;

            // Check if taskIds array is not empty
            if (!empty($taskIds)) {
                // Iterate through taskIds
                foreach ($taskIds as $taskId) {
                    // Check if taskId is not null
                    if (!is_null($taskId)) {
                        // Make the API call to capture the lead
                        $result = $api->postAPI('lead/capture', ['lead_id' => $taskId, 'status_id' => $boardColumnId]);

                        // Check if the API call was successful
                        if ($result['status'] != 'success') {
                            // Handle the case where the API call fails
                            return Reply::error('Failed to capture lead');
                        }
                    }
                }
            }

            // Return a success response
            return Reply::dataOnly(['status' => 'success']);
        } else {
            // Handle the case where the first API call fails or data is not available
            return Reply::error('Failed to retrieve leadboard status list');
        }
    }
}
