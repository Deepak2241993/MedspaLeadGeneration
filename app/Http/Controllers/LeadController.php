<?php

namespace App\Http\Controllers;

use App\Models\CommonModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LeadController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:lead_view',['only' => ['index']]);
        $this->middleware('permission:lead_edit',['only' => ['edit','update']]);
        $this->middleware('permission:lead_delete',['only' => ['destroy']]);

        $this->middleware('permission:archived_view',['only' => ['archived']]);
        $this->middleware('permission:archived_restore',['only' => ['restore']]);

        $this->middleware('permission:archived_delete',['only' => ['permanentdelete']]);
    }
    public function submitForm(Request $request)
    {
        // dd($request->all());
        $api = new CommonModel();
        $data_arr = $request->except('_token','receiveTextMessages','status_id');
        $data_arr['source'] = 'Facebook';
        $data = json_encode($data_arr);
        // dd($data);
        $result = $api->postAPI('lead/capture', $data);

        // dd($result);
        if (isset($result['status']) && $result['status'] == 'error') {
            // dd($result['error']);
            return back()->with('imperialheaders_success', $result['responseMessage']);
        } else {
            // dd($result['error']);
            return back()->with('imperialheaders_success', $result['responseMessage']);
        }
    }
    public function index(Request $request)
{
    $api = new CommonModel();

    // Fetch leads
    $leadsResult = $api->getAPI('lead/list/0');

    // Fetch statuses
    $statusesResult = $api->getAPI('leadboard/status/list');

    // Initialize variables for leads and statuses
    $leads = [];
    $statuses = [];
    $statusMap = [];
    $errorMessage = null;

    // Handle leads result
    if (is_array($leadsResult) && isset($leadsResult['status'])) {
        if ($leadsResult['status'] == "success") {
            $leads = $leadsResult['data'];
        } else {
            $errorMessage = 'Failed to retrieve leads.';
        }
    } else {
        $errorMessage = 'Failed to retrieve data from API for leads.';
    }

    // Handle statuses result
    if (is_array($statusesResult) && isset($statusesResult['status'])) {
        if ($statusesResult['status'] == "success") {
            $statuses = $statusesResult['data'];
            // Create a map of status ID to status name
            foreach ($statuses as $status) {
                $statusMap[$status['_id']] = $status['name'];
            }
        } else {
            $errorMessage = 'Failed to retrieve statuses.';
        }
    } else {
        $errorMessage = 'Failed to retrieve data from API for statuses.';
    }

    // Map status names to leads
    foreach ($leads as &$lead) {
        if (isset($statusMap[$lead['status_id']])) {
            $lead['status_name'] = $statusMap[$lead['status_id']];
        } else {
            $lead['status_name'] = 'Unknown Status';
        }
    }

    // Check for empty data
    if (empty($leads) && empty($statuses)) {
        $errorMessage = 'No data found.';
    }

    return view('leads.index', compact('leads', 'statuses', 'errorMessage'));
}



    public function edit($id)
    {
        $api = new CommonModel();
        $result = $api->getAPI('lead/view/' . $id);

        if ($result['status'] === 'success') {
            if (!empty($result['data'])) {
                $lead = $result['data'];
                return view('leads.edit', compact('lead'));
            } else {
                return redirect()->route('error.page')->with('error', 'Lead not found');
            }
        } else {
            $errorMessage = isset($result['message']) ? $result['message'] : 'Unknown error';
            return redirect()->route('error.page')->with('error', 'API request failed: ' . $errorMessage);
        }
    }
    public function update(Request $request, $id)
    {
        //  dd($request->all());

        $api = new CommonModel();
        $data_arr = $request->except('_token');
        $data_arr['source'] = 'Facebook';
        $data = json_encode($data_arr);

        // Assuming postAPI returns the API response as an associative array
        $apiResult = $api->postAPI("lead/update", $data);

        // dd($apiResult);
        // Check if the API call was successful based on the API response
        if ($apiResult && $apiResult['status'] === 'success') {

            return redirect()->route('leads.index')->with('success', 'Lead updated successfully');
        } else {
            // Handle the case where the API call did not return success
            $errorMessage = isset($apiResult['message']) ? $apiResult['message'] : 'Failed to update lead via API';
            return redirect()->route('leads.edit', $id)->with('error', $errorMessage);
        }
    }
    public function destroy($id)
    {
        $api = new CommonModel();
        $apiResult = $api->postAPI('lead/archive/' . $id, []);

        // Check if the API call was successful based on the API response
        if ($apiResult && $apiResult['status'] === 'success') {
            return redirect()->route('leads.index')->with('success', 'Lead Delete successfully');
        } else {
            // Handle the case where the API call did not return success
            $errorMessage = isset($apiResult['message']) ? $apiResult['message'] : 'Failed to delete lead via API';
            return redirect()->route('leads.index')->with('error', $errorMessage);
        }
    }
    public function destroyMultiple(Request $request)
    {
        // dd($request->all());
        $ids = $request->input('ids', []);

        if (empty($ids)) {
            return response()->json(['message' => 'No lead IDs provided'], 400);
        }

        $api = new CommonModel();
        $errors = [];
        $successCount = 0;

        foreach ($ids as $id) {
            $apiResult = $api->postAPI('lead/archive/' . $id, []);

            // Check if the API call was successful based on the API response
            if ($apiResult && $apiResult['status'] === 'success') {
                $successCount++;
            } else {
                // Handle the case where the API call did not return success
                $errorMessage = isset($apiResult['message']) ? $apiResult['message'] : 'Failed to delete lead via API';
                $errors[] = ['id' => $id, 'message' => $errorMessage];
            }
        }

        if ($successCount > 0) {
            return response()->json(['message' => 'Selected columns deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Error deleting columns', 'errors' => $errors], 500);
        }
    }

    public function archived(Request $request)
    {
        $api = new CommonModel();
        $result = $api->getAPI('lead/list/1');
        if (is_array($result) && isset($result['status'])) {
            if ($result['status'] == "success") {
                $data = ['data' => $result['data']];
                return view('leads.archived', $data);
            } else {
                $error_message = 'Failed to retrieve archived leads.';
            }
        } else {
            $error_message = 'Failed to connect to the API.';
        }
        return redirect()->back()->with('error', $error_message);
    }

    public function restore($id)
    {
        try {
            $api = new CommonModel();
            $result = $api->postAPI("lead/restore/{$id}", []);

            if ($result['status'] === 'success') {
                return redirect()->route('leads.archived')->with('success', 'Lead Archived successfully');
            } else {
                Log::error('API request failed: ' . json_encode($result));
                return response()->json(['error' => 'Error restoring lead'], 500);
            }
        } catch (\Exception $e) {
            Log::error('Exception: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
    public function permanentdelete($id)
    {
        try {
            $api = new CommonModel();
            $result = $api->postAPI("lead/delete/{$id}", []);

            if ($result['status'] === 'success') {
                return redirect()->route('leads.archived')->with('success', 'Lead Permanently Deleted');
            } else {
                Log::error('API request failed: ' . json_encode($result));
                return response()->json(['error' => 'Error restoring lead'], 500);
            }
        } catch (\Exception $e) {
            Log::error('Exception: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
