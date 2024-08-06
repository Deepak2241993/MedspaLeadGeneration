<?php

namespace App\Http\Controllers;

use App\Helper\Reply;
use Illuminate\Http\Request;
use App\Models\CommonModel;

class LeadStatusSettingController extends Controller
{

    public function create()
    {
        return view('lead-settings.create-status-modal');
    }
    public function store(Request $request)
    {
        $api = new CommonModel();
    
        // Set the attributes manually
        $api->name = $request->name;
        $api->label_color = $request->label_color;
    
        // Save the model to the database
        // (If there is no actual save operation, you might need to add it here)
    
        // Now that the data is saved, make the API request
        $result = $api->postAPI('lead/status/add', $request);
    
        // Check the result of the API request and handle it accordingly
        if (isset($result['status']) && $result['status'] == 'error') {
            // If the API request fails, handle the error scenario
            return response()->json([
                'status' => 'error',
                'message' => 'API request failed',
                'details' => $result['responseMessage'] ?? 'No additional details'
            ], 500);
        }
    
        // If successful, return a success response
        return response()->json([
            'status' => 'success',
            'message' => 'Record Saved'
        ]);
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

    public function update(Request $request, $id)
    {
        $type = LeadStatus::findOrFail($id);
        $oldPosition = $type->priority;
        $newPosition = $request->priority;

        if ($oldPosition < $newPosition) {

            LeadStatus::where('priority', '>', $oldPosition)
                ->where('priority', '<=', $newPosition)
                ->orderBy('priority', 'asc')
                ->decrement('priority');
        } else if ($oldPosition > $newPosition) {

            LeadStatus::where('priority', '<', $oldPosition)
                ->where('priority', '>=', $newPosition)
                ->orderBy('priority', 'asc')
                ->increment('priority');
        }

        $type->type = $request->type;
        $type->label_color = $request->label_color;
        $type->priority = $request->priority;
        $type->save();

        return Reply::success(__('messages.updateSuccess'));
    }

    public function destroy($id)
    {

        $api = new CommonModel();
        $result = $api->getAPI('lead/list/0');

        dd($result);

        $defaultLeadStatus = LeadStatus::where('default', 0)->first();

        dd($defaultLeadStatus);
        die;
        LeadData::where('status_id', $id)->update(['status_id' => $defaultLeadStatus->id]);

        $board = LeadStatus::findOrFail($id);

        $otherColumns = LeadStatus::where('priority', '>', $board->priority)
            ->orderBy('priority', 'asc')
            ->get();

        foreach ($otherColumns as $column) {
            $pos = LeadStatus::where('priority', $column->priority)->first();
            $pos->priority = ($pos->priority - 1);
            $pos->save();
        }

        // UserLeadboardSetting::where('board_column_id', $id)->delete();
        LeadStatus::destroy($id);

        return Reply::success(__('messages.deleteSuccess'));
    }
}
