<?php

namespace App\Http\Controllers;

use App\Helper\Reply;
use Illuminate\Http\Request;
use App\Models\CommonModel;
use Illuminate\Support\Facades\Log;

class LeadStatusSettingController extends Controller
{


    public function store(Request $request)
    {
        $api = new CommonModel();
        $data = [
            'name' => $request->input('columnName'),
            'label_color' => ltrim($request->input('columnColor'), '#')
        ];
        
        if (empty($data['name']) || empty($data['label_color'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Missing required fieldsssssssss'
            ], 400);
        }
        $data = json_encode($data);
        $result = $api->postAPI('leadboard/status/add', $data);
        if (isset($result['status'])) {
            if ($result['status'] == 'success') {
                // If successful, return a success response
                return response()->json([
                    'status' => 'success',
                    'message' => 'Record Saved'
                ]);
            } elseif ($result['status'] == 'error') {
                // If the API request fails, handle the error scenario
                return response()->json([
                    'status' => 'error',
                    'message' => 'API request failed',
                    'details' => $result['responseMessage'] ?? 'No additional details'
                ], 500);
            }
        }
        return response()->json([
            'status' => 'error',
            'message' => 'API response is not valid or missing status'
        ], 500);
    }

    public function edit(Request $request, $id)
    {
        $api = new CommonModel();

        // Call the API endpoint to get the lead status for editing
        $result = $api->getAPI('leadboard/status/edit/' . $id);
        // Check if the API call was successful
        if ($result['status'] == "success") {
            // Extract the lead status data from the API response
            $leadStatusData = $result['data'];

            return view('admin.lead-settings.edit-status-modal', compact('leadStatusData'));
        } else {

            return redirect()->back()->with('error', 'Failed to retrieve lead status for editing');
        }
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $api = new CommonModel();
        
        // Extract and map input data to the API format
        $data_arr = $request->except('_token');
        $mapped_data = [
            '_id' => $data_arr['columnId'],
            'label_color' => str_replace('#', '', $data_arr['columnColor']),
            'priority' => $data_arr['columnPosition'],
            'name' => $data_arr['columnName']
        ];
        $data = json_encode($mapped_data);
        // dd($data);

        // Assuming postAPI returns the API response as an associative array
        try {
            $apiResult = $api->postAPI("leadboard/status/update", $data);
            
            // Log the API response for debugging
            Log::info('API Response:', ['response' => $apiResult]);

            // Check if the API call was successful based on the API response
            if (isset($apiResult['status']) && $apiResult['status'] === 'success') {
                return response()->json(['success' => true, 'message' => 'Lead updated successfully']);
            } else {
                // Handle the case where the API call did not return success
                $errorMessage = isset($apiResult['message']) ? $apiResult['message'] : 'Failed to update lead via API';
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage,
                    'api_response' => $apiResult // Include the full API response for debugging
                ]);
            }
        } catch (\Exception $e) {
            // Log any exceptions that occur
            Log::error('API Request Failed:', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the lead.',
                'error' => $e->getMessage()
            ]);
        }


        // $type = LeadStatus::findOrFail($id);
        // $oldPosition = $type->priority;
        // $newPosition = $request->priority;

        // if ($oldPosition < $newPosition) {

        //     LeadStatus::where('priority', '>', $oldPosition)
        //         ->where('priority', '<=', $newPosition)
        //         ->orderBy('priority', 'asc')
        //         ->decrement('priority');
        // } else if ($oldPosition > $newPosition) {

        //     LeadStatus::where('priority', '<', $oldPosition)
        //         ->where('priority', '>=', $newPosition)
        //         ->orderBy('priority', 'asc')
        //         ->increment('priority');
        // }

        // $type->type = $request->type;
        // $type->label_color = $request->label_color;
        // $type->priority = $request->priority;
        // $type->save();

        // return Reply::success(__('messages.updateSuccess'));
    }

    public function destroy($id)
    {
        // dd($id);

        $api = new CommonModel();
        $result = $api->postAPI('leadboard/status/delete/' . $id, []);

        // dd($result);

        // Check if the API call was successful based on the API response
        if ($result && $result['status'] === 'success') {
            return redirect()->route('leadboard')->with('success', 'Leadboad Delete successfully');
        } else {
            // Handle the case where the API call did not return success
            $errorMessage = isset($result['message']) ? $result['message'] : 'Failed to delete lead via API';
            return redirect()->route('leadboard')->with('error', $errorMessage);
        }
    }
}
