<?php

namespace App\Http\Controllers;

use App\Models\CommonModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Exports\HeaderOnlyExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\LeadsImport;
use App\Exports\LeadsExport;

class LeadController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:lead_view', ['only' => ['index']]);
        $this->middleware('permission:lead_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:lead_delete', ['only' => ['destroy']]);

        $this->middleware('permission:archived_view', ['only' => ['archived']]);
        $this->middleware('permission:archived_restore', ['only' => ['restore']]);

        $this->middleware('permission:archived_delete', ['only' => ['permanentdelete']]);
    }
    public function checkPhoneNumber(Request $request)
    {
        // Validate the inputs first
        $validatedData = $request->validate([
            'phone' => 'required|string',
        ]);
        $phone = $request->input('phone');

        // Remove special characters and spaces from the phone number
        $cleanedPhone = preg_replace('/[\(\)\-\s]/', '', $phone);

        $api = new CommonModel();
        $leads = $api->getAPI('lead/list/0');

        $exists = false; // Flag to track if the phone exists

        if (is_array($leads) && !empty($leads)) {
            foreach ($leads['data'] as $lead) {
                $leadPhone = preg_replace('/[\(\)\-\s]/', '', $lead['phone']); // Clean lead phone

                // Compare cleaned phone without country code
                if (isset($leadPhone) && $leadPhone === $cleanedPhone) {
                    $exists = true;
                    break; // Stop the loop once the lead is found
                }
            }
        }
        // Prepare the response message
        $message = $exists ? 'The User With This Phone Number Aready Exists' : '';

        return response()->json(['exists' => $exists, 'message' => $message]);
    }
    public function submitForm(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string',
        ]);
        $validatedData['phone'] = preg_replace('/[^\d]/', '', $validatedData['phone']);
        $data_arr = $request->except('_token', 'receiveTextMessages', 'status_id');
        $data_arr['phone'] = $validatedData['phone'];
        $data_arr['source'] = 'Facebook';
        $data = json_encode($data_arr);
        $api = new CommonModel();
        $result = $api->postAPI('lead/capture', $data);
        if (isset($result['status']) && $result['status'] == 'error') {
            return back()->with('imperialheaders_error', $result['responseMessage']);
        }

        return back()->with('imperialheaders_success', "Form Submitted Successfully");
    }
    public function index(Request $request)
    {
        $users = User::all();

        $userRoles = [];

        foreach ($users as $user) {
            $roles = $user->getRoleNames();
            $userRoles[] = [
                'id' => $user->id,       
                'name' => $user->name,   
                'roles' => $roles        
            ];
        }
        $api = new CommonModel();

        // Fetch leads
        $leadsResult = $api->getAPI('lead/list/0');

        // Fetch statuses
        $statusesResult = $api->getAPI('leadboard/status/list');

        // Initialize variables for leads and statuses
        $leads = [];
        $statuses = [];
        $statusMap = [];
        $statusName = null; // Default to null
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

        // Retrieve the status_id from the query string
        $statusId = $request->query('status_id');

        // Map status names to leads and format updated_on
        $uniqueLeads = [];
        $uniqueKeys = []; // To track unique combinations of country_code and phone

        foreach ($leads as &$lead) {
            // Create a unique key based on country_code and phone without underscore
            $uniqueKey = $lead['country_code'] . $lead['phone'];

            // Check if the unique key is already processed
            if (!in_array($uniqueKey, $uniqueKeys)) {
                $uniqueKeys[] = $uniqueKey; // Add to tracked unique keys

                // Assign status name
                $lead['status_name'] = $statusMap[$lead['status_id']] ?? 'Unknown Status';

                // Format the 'updated_on' date to a more readable format
                $lead['updated_on_formatted'] = date('d-m-Y H:i:s', strtotime($lead['updated_on']));

                $uniqueLeads[] = $lead; // Add unique lead to the new array
            }
        }

        // Filter unique leads based on the provided status_id
        if ($statusId) {
            if (isset($statusMap[$statusId])) {
                $uniqueLeads = array_filter($uniqueLeads, function ($lead) use ($statusId) {
                    return $lead['status_id'] === $statusId;
                });
                $uniqueLeads = array_values($uniqueLeads); // Re-index the filtered array
                $statusName = $statusMap[$statusId] ?? 'Unknown Status';
            } else {
                $errorMessage = 'Invalid status selected.';
            }
        }

        // Sort unique leads by 'updated_on' in descending order
        usort($uniqueLeads, function ($a, $b) {
            return strtotime($b['updated_on']) <=> strtotime($a['updated_on']);
        });

        // Check if no data is found
        if (empty($uniqueLeads) && empty($statuses)) {
            $errorMessage = 'No data found.';
        }

        return view('leads.index', compact('uniqueLeads', 'statuses', 'errorMessage', 'statusName','userRoles'));
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
        if (isset($data_arr['phone'])) {
            // Remove dashes and spaces from the phone number
            $data_arr['phone'] = preg_replace('/[-\s]/', '', $data_arr['phone']);
        }
        $data_arr['source'] = 'Facebook';
        $data = json_encode($data_arr);

    // dd($data);
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
            return redirect()->route('leads.index')->with('success', 'Lead Deleted successfully');
        } else {
            // Handle the case where the API call did not return success
            $errorMessage = isset($apiResult['message']) ? $apiResult['message'] : 'Failed to delete lead via API';
            return redirect()->route('leads.index')->with('error', $errorMessage);
        }
    }
    public function destroyMultiple(Request $request)
    {
        // Validate the incoming request to ensure 'ids' is an array and not empty
        $validated = $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'string', // Ensure each ID is a string (or change to another type if necessary)
        ]);

        $ids = $validated['ids']; // After validation, the IDs are safe to use.

        $api = new CommonModel();
        $errors = [];
        $successCount = 0;

        // Iterate through each ID to attempt deletion
        foreach ($ids as $id) {
            $apiResult = $api->postAPI("lead/delete/{$id}", []); // Use $apiResult to be consistent

            // Check if the API call was successful
            if ($apiResult && $apiResult['status'] === 'success') {
                $successCount++;
            } else {
                // Collect error messages for failed deletions
                $errorMessage = isset($apiResult['message']) ? $apiResult['message'] : 'Failed to delete lead via API';
                $errors[] = ['id' => $id, 'message' => $errorMessage];
            }
        }

        // If any deletions were successful, return success response
        if ($successCount > 0) {
            return response()->json([
                'message' => "{$successCount} leads deleted successfully",  // Add the count to the message
                'successCount' => $successCount,
                'errors' => $errors,
            ], 200);
        }

        // If no deletions succeeded, return error response
        return response()->json([
            'message' => 'Error deleting leads',  // Change 'columns' to 'leads' for clarity
            'errors' => $errors,
        ], 500);
    }

    public function archived(Request $request)
    {
        $api = new CommonModel();
        $result = $api->getAPI('lead/list/1');

        $data = []; // Initialize $data to avoid undefined variable error
        $error_message = null; // Initialize error message

        if (is_array($result) && isset($result['status'])) {
            if ($result['status'] == "success") {
                if (!empty($result['data'])) {
                    // Data exists, pass it to the view
                    $data = $result['data'];
                } else {
                    // No archived leads
                    $error_message = 'No archived leads available.';
                }
            } else {
                $error_message = 'No Archived Leads Present.';
            }
        } else {
            $error_message = 'Failed to connect to the API.';
        }

        // Pass both $data and $error_message to the view
        return view('leads.archived', compact('data', 'error_message'));
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
                return redirect()->route('leads.archived')->with('success', 'Deleted Permanently');
            } else {
                Log::error('API request failed: ' . json_encode($result));
                return response()->json(['error' => 'Error restoring lead'], 500);
            }
        } catch (\Exception $e) {
            Log::error('Exception: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
    public function restoreMultiple(Request $request)
    {
        // Ensure that the 'ids' input is treated as an array
        $ids = $request->input('ids');

        // If the input is not already an array, convert it to an array
        if (!is_array($ids)) {
            $ids = explode(',', $ids); // Assuming the IDs might be comma-separated
        }

        if (!empty($ids)) {
            $api = new CommonModel();
            $failedRestores = [];

            foreach ($ids as $id) {
                try {
                    $result = $api->postAPI("lead/restore/{$id}", []);

                    if ($result['status'] !== 'success') {
                        $failedRestores[] = $id;
                        Log::error("Failed to restore lead with ID: {$id}. Response: " . json_encode($result));
                    }
                } catch (\Exception $e) {
                    $failedRestores[] = $id;
                    Log::error("Exception occurred while restoring lead with ID: {$id}. Exception: " . $e->getMessage());
                }
            }

            if (empty($failedRestores)) {
                return redirect()->route('leads.index')->with('success', 'Selected leads restored successfully.');
            } else {
                return redirect()->route('leads.index')->with('warning', 'Some leads could not be restored. Check logs for details.');
            }
        }

        return redirect()->route('leads.index')->withErrors(['No leads selected for restoration.']);
    }
    public function create()
    {
        return view('leads.create');
    }
    public function store(Request $request)
    {
        $user = Auth::user();
        $userName = $user ? $user->name : 'Guest';
        $api = new CommonModel();
        $data_arr = $request->except('_token', 'receiveTextMessages', 'status_id');
        $data_arr['source'] = "crm/{$userName}";
        $data = json_encode($data_arr);
        // dd($data);
        $result = $api->postAPI('lead/capture', $data);

        // dd($result);
        if (isset($result['status']) && $result['status'] == 'error') {
            // dd($result['error']);
            return back()->with('imperialheaders_error', $result['responseMessage']);
        } else {
            // dd($result['error']);
            return back()->with('imperialheaders_success', "Lead From Submitted Successfully");
        }
    }
    public function exportHeadersOnly()
    {
        return Excel::download(new HeaderOnlyExport, 'headers_only.xlsx');
    }
    public function exportLeadsCsv()
    {
        return Excel::download(new LeadsExport, 'leads.csv', \Maatwebsite\Excel\Excel::CSV);
    }
    public function importLeads(Request $request)
    {
        // Log the start of the import process
        Log::info('Lead import process started.');

        // Validate that only CSV files are allowed
        Log::info('Validating the file format and size...');
        $request->validate([
            'file' => 'required|file|mimes:csv,txt|max:2048', // Accept CSV and limit file size to 2MB for testing
        ]);

        // Log the file details
        if ($request->hasFile('file')) {
            Log::info('File received:', [
                'original_name' => $request->file('file')->getClientOriginalName(),
                'size' => $request->file('file')->getSize(),
                'mime_type' => $request->file('file')->getMimeType(),
            ]);
        } else {
            Log::warning('No file received in the request.');
            return redirect()->back()->with('error', 'No file was uploaded.');
        }

        try {
            // Start importing the CSV file
            Log::info('Attempting to import the CSV file...');
            Excel::import(new LeadsImport, $request->file('file'));

            Log::info('Leads imported successfully.');
            return redirect()->back()->with('success', 'Leads imported successfully.');
        } catch (\Exception $e) {
            // Log the error with detailed information
            Log::error('Lead import failed:', [
                'error' => $e->getMessage(),
                'file' => $request->file('file')->getClientOriginalName(),
            ]);
            return redirect()->back()->with('error', 'Error importing leads: ' . $e->getMessage());
        }
    }
}
