<?php

namespace App\Http\Controllers;

use App\Models\CommonModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $api = new CommonModel();
        $result = $api->getAPI('lead/list/0');

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

                return view('leads.index', compact('data', 'message'));
            } else {
                // Handle the case where API call was successful but status is not "success"
                $error_message = 'Failed to retrieve leads.';
                return view('leads.index', compact('error_message'));
            }
        } else {
            // Handle the case where $result is null or not an array (API call failed)
            $error_message = 'Failed to retrieve data from API.';
            return view('leads.index', compact('error_message'));
        }
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
        // Remove the unnecessary dd($request->all());

        $api = new CommonModel();
        $data_arr = $request->except('_token');
        $data_arr['source'] = 'Facebook';
        $data = json_encode($data_arr);

        // Assuming postAPI returns the API response as an associative array
        $apiResult = $api->postAPI("lead/update", $data);

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
    public function archived(Request $request)
    {
        $api = new CommonModel();
        $result = $api->getAPI('lead/list/1');

        if ($result['status'] == "success") {
            $data = ['data' => $result['data']]; // Pass data as an array

            return view('leads.archived', $data);
        } else {
            // Handle the error case
            return redirect()->back()->with('error', 'No Data Archived leads.');
        }
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
}
