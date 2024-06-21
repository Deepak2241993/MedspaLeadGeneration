<?php

namespace App\Http\Controllers;

use App\Models\LeadStatus;
use App\Models\LeadData;
use Illuminate\Http\Request;
use App\Helper\Reply;

use App\Models\CommonModel;

// use App\Models\LeadData;
// use App\Models\LeadStatus;
// use App\Models\DB;

class LeadboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

            // dd($leadStatuses);
            // 58190ffabf981aa3956f64e7

            // Return the view with the extracted data
            return view('admin.leadboard.index', compact('leadStatuses', 'leadData'));
        } else {
            // Handle the case where one or both API calls failed
            return response()->json(['error' => 'Data Not Found']);
        }
    }

    // public function index(Request $request)
    // {
    //     $api = new CommonModel();
    //     $result1 = $api->getAPI('leadboard/status/list');
    //     $result2 = $api->getAPI('lead/list/0');

    //     if ($result1['status'] == "success" && $result2['status'] == "success") {
    //         // Merge the data from both responses
    //         $mergedData = collect($result1['data'])->merge($result2['data']);

    //         dd($mergedData);
    //     } else {
    //         // Handle the case where one or both API calls failed
    //         return response()->json(['error' => 'Data Not Found']);
    //     }

    //     // Fetch LeadStatus records with their related LeadData records
    //     $leadStatuses = LeadStatus::with('leadData')->get();

    //     // Accessing the LeadStatus and related LeadData records
    //     foreach ($leadStatuses as $leadStatus) {
    //         // Accessing the LeadStatus data
    //         // dd($leadStatus);

    //         // Accessing the related LeadData records
    //         // dd($leadStatus->leadData);
    //     }

    //     // Return the view with the leadStatuses data
    //     return view('admin.leadboard.index', compact('leadStatuses'));
    // }
    public function updatePriority(Request $request)
    {
        $columnId = $request->input('column_id');
        $newPriorityOrder = $request->input('new_priority_order');

        // Update the priorities in your database based on the new order

        return response()->json(['success' => true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //     $dataLeft = LeadStatus::select('lead_status.*', 'lead_data.id as lead_data_id')
        //     ->leftJoin('lead_data', 'lead_status.id', '=', 'lead_data.status_id')
        //     ->get();

        // $dataRight = LeadData::select('lead_data.*', 'lead_status.id as lead_status_id')
        //     ->rightJoin('lead_status', 'lead_data.status_id', '=', 'lead_status.id')
        //     // ->whereNull('lead_status.id') // Filtering out the rows that were already retrieved in the left join
        //     ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // public function updateIndex(Request $request)
    // {
    //     $taskIds = $request->taskIds;
    //     $boardColumnId = $request->boardColumnId;
    //     $priorities = $request->prioritys;


    //     $board = LeadStatus::findOrFail($boardColumnId);

    //     // dd($board);
    //     if (isset($taskIds) && count($taskIds) > 0) {

    //         $taskIds = (array_filter($taskIds, function ($value) {
    //             return $value !== null;
    //         }));

    //         foreach ($taskIds as $key => $taskId) {
    //             if (!is_null($taskId)) {
    //                 $task = LeadData::findOrFail($taskId);
    //                 $task->update(
    //                     [
    //                         'status_id' => $boardColumnId,
    //                         // 'priority' => $priorities[$key]
    //                     ]
    //                 );
    //             }
    //         }
    //     }

    //     return Reply::dataOnly(['status' => 'success']);
    // }
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
