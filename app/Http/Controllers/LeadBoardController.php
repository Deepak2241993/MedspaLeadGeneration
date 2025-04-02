<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommonModel;
use Illuminate\Support\Facades\Log;

class LeadBoardController extends Controller
{
    // public function index(Request $request)
    // {

    //     $api = new CommonModel();
    //     $result1 = $api->getAPI('leadboard/status/list');
    //     $result2 = $api->getAPI('lead/list/0');
    //     if ($result1['status'] == "success" && $result2['status'] == "success") {
    //         $leadStatuses = $result1['data'];
    //         $leadData = $result2['data'];
    //         usort($leadData, function($a, $b) {
    //             return strtotime($b['updated_on']) <=> strtotime($a['updated_on']);
    //         });
    //         return view('leadboard.index', compact('leadStatuses', 'leadData'));
    //     } else {
    //         return response()->json(['error' => 'Data Not Found']);
    //     }
    // }
    // public function index(Request $request)
    // {
    //     $api = new CommonModel();

    //     // Fetch status and lead data from the API
    //     $statusResponse = $api->getAPI('leadboard/status/list');
    //     $leadResponse = $api->getAPI('lead/list/0');

    //     // Check if both API calls are successful
    //     if ($statusResponse['status'] == "success" && $leadResponse['status'] == "success") {
    //         $leadStatuses = $statusResponse['data'];
    //         $leadData = $leadResponse['data'];

    //         // Sort leadData by updated_on field in descending order
    //         usort($leadData, function ($a, $b) {
    //             return strtotime($b['updated_on']) <=> strtotime($a['updated_on']);
    //         });

    //         // Sort leadStatuses by priority in ascending order (1, 2, 3, ...)
    //         usort($leadStatuses, function ($a, $b) {
    //             return $a['priority'] <=> $b['priority'];
    //         });

    //         // Pass the sorted data to the view
    //         return view('leadboard.index', compact('leadStatuses', 'leadData'));
    //     } else {
    //         // Handle API error
    //         return response()->json(['error' => 'Data not found'], 404);
    //     }
    // }
    public function index(Request $request)
{
    $api = new CommonModel();

    // Fetch status and lead data from the API
    $statusResponse = $api->getAPI('leadboard/status/list');
    $leadResponse = $api->getAPI('lead/list/0');

    // Check if both API calls are successful
    if ($statusResponse['status'] == "success" && $leadResponse['status'] == "success") {
        $leadStatuses = $statusResponse['data'];
        $leadData = $leadResponse['data'];

        // Track unique combinations of country_code and phone
        $uniqueLeads = [];
        $seen = [];

        foreach ($leadData as $lead) {
            // Create a unique key based on country_code and phone
            $uniqueKey = $lead['country_code'] . $lead['phone'];

            // Check if this combination has been encountered before
            if (!isset($seen[$uniqueKey])) {
                $uniqueLeads[] = $lead;
                $seen[$uniqueKey] = true; // Mark this combination as seen
            }
        }

        // Sort uniqueLeads by updated_on field in descending order
        usort($uniqueLeads, function ($a, $b) {
            return strtotime($b['updated_on']) <=> strtotime($a['updated_on']);
        });

        // Sort leadStatuses by priority in ascending order (1, 2, 3, ...)
        usort($leadStatuses, function ($a, $b) {
            return $a['priority'] <=> $b['priority'];
        });

        // Pass the sorted data to the view
        return view('leadboard.index', compact('leadStatuses', 'uniqueLeads'));
    } else {
        // Handle API error
        return response()->json(['error' => 'Data not found'], 404);
    }
}


    public function updateIndex(Request $request)
    {
        $api = new CommonModel();
        $status_id = $request->input('column_name');
        $task_id = $request->input('task_id');

        $data_arr = [
            'status_id' => $status_id,
            '_id' => $task_id
        ];
        $data = json_encode($data_arr);

        $apiResult = $api->postAPI("lead/update", $data);
        if (isset($apiResult['status'])  && $apiResult['status'] === 'success') {
            return redirect()->route('leadboard')->with('success', 'Leadboad status updated successfully');
        } else {
            $errorMessage = isset($apiResult['message']) ? $apiResult['message'] : 'Failed to update lead status via API';
            return redirect()->route('leadboard')->with('error', $errorMessage);
        }
    }
    public function updateAssignee(Request $request)
    {
        // dd($request->all());
        $api = new CommonModel();
        $assignee_id = $request->input('assignee_id');
        $task_id = $request->input('task_id');

        $data_arr = [
            'assignee_id' => $assignee_id,
            '_id' => $task_id
        ];
        $data = json_encode($data_arr);

        $apiResult = $api->postAPI("lead/update", $data);
        if (isset($apiResult['status'])  && $apiResult['status'] === 'success') {
            return redirect()->route('leadboard')->with('success', 'Leadboad status updated successfully');
        } else {
            $errorMessage = isset($apiResult['message']) ? $apiResult['message'] : 'Failed to update lead status via API';
            return redirect()->route('leadboard')->with('error', $errorMessage);
        }
    }
}
