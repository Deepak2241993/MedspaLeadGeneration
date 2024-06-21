<?php

namespace App\Http\Controllers;

use App\Helper\Reply;
use Illuminate\Http\Request;
use App\Models\LeadStatus;
use App\Models\LeadData;
use App\Models\CommonModel;
use Illuminate\Support\Facades\Validator;

class LeadStatusSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.lead-settings.create-status-modal');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        $api = new CommonModel();

        // Set the attributes manually
        $api->name = $request->name;
        $api->label_color = $request->label_color;
        $data_arr = $request->except('_token');
        $data = json_encode($data_arr);


        dd($data);
        // Save the model to the database


        // Now that the data is saved, make the API request
        $result = $api->postAPI('lead/status/add', $data);


        dd($result);
        // Check the result of the API request and handle it accordingly
        if (isset($result['status']) && $result['status'] == 'error') {

            dd('jhvzafjhvasdf');
            // If the API request fails, you might want to handle this scenario
            return Reply::error('API request failed', $result['responseMessage']);
        }

        return Reply::success('Record Saved');
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
    // public function edit($id)
    // {
    //     $api = new CommonModel();

    //     $result = $api->getAPI('lead/status/edit', $id);

    //     dd( $result);


    //     if ($result['status'] == "success") {

    //         $leaddata = collect($result['data']);
    //         dd($leaddata);


    //     }


    //     // $result = $api->postAPI('lead/status/edit', $id);

    //     // $status = LeadStatus::findOrFail($id);

    //     // dd($status);
    //     // $maxPriority = LeadStatus::max('priority');

    //     return view('admin.lead-settings.edit-status-modal', compact('status', 'maxPriority'));
    // }

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


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {

    //     $api = new CommonModel();
    //     $data_arr = $request->except('_token');
    //     // Convert data array to JSON
    //     $data = json_encode($data_arr);



    //     dd($data);
    //     // Assuming postAPI returns the API response as an associative array
    //     $apiResult = $api->postAPI("leadboard/status/update", $data);

    //     dd($apiResult);

    //     $api = new CommonModel();

    //     $data_arr = $request->except('_token');

    //     // Convert data array to JSON
    //     $data = json_encode($data_arr);

    //     // Assuming postAPI returns the API response as an associative array
    //     $apiResult = $api->postAPI("leadboard/status/update", $data);


    //     dd($apiResult);




    //     // Assuming postAPI returns the API response as an associative array
    //     $apiResult = $api->postAPI("lead/update", $data);



    //     $type = LeadStatus::findOrFail($id);
    //     $oldPosition = $type->priority;
    //     $newPosition = $request->priority;

    //     if ($oldPosition < $newPosition) {

    //         LeadStatus::where('priority', '>', $oldPosition)
    //             ->where('priority', '<=', $newPosition)
    //             ->orderBy('priority', 'asc')
    //             ->decrement('priority');
    //     } else if ($oldPosition > $newPosition) {

    //         LeadStatus::where('priority', '<', $oldPosition)
    //             ->where('priority', '>=', $newPosition)
    //             ->orderBy('priority', 'asc')
    //             ->increment('priority');
    //     }

    //     $type->type = $request->type;
    //     $type->label_color = $request->label_color;
    //     $type->priority = $request->priority;
    //     $type->save();

    //     return Reply::success(__('messages.updateSuccess'));
    // }

    public function update(Request $request, $id)
    {
        $api = new CommonModel();
        
        // Extract data from request
        $data_arr = $request->except('_token');
    
        // Convert data array to JSON
        $data = json_encode($data_arr);
    
        // Assuming postAPI returns the API response as an associative array
        $apiResult = $api->postAPI("leadboard/status/update", $data);
    
        // Check if the API call was successful and the returned status is 'success'
        if ($apiResult && isset($apiResult['status']) && $apiResult['status'] === 'success') {
            return Reply::success(__('messages.updateSuccess'));
        } else {
            // Handle the case where the API call did not return success
            return redirect()->route('admin.leadboard')->with('error', 'Failed to update lead via API');
        }
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //ksdubfg
// // Update lead status priority
// $type = LeadStatus::findOrFail($id);
// $oldPosition = $type->priority;
// $newPosition = $request->priority;

// if ($oldPosition < $newPosition) {
//     LeadStatus::where('priority', '>', $oldPosition)
//         ->where('priority', '<=', $newPosition)
//         ->orderBy('priority', 'asc')
//         ->decrement('priority');
// } elseif ($oldPosition > $newPosition) {
//     LeadStatus::where('priority', '<', $oldPosition)
//         ->where('priority', '>=', $newPosition)
//         ->orderBy('priority', 'asc')
//         ->increment('priority');
// }

// // Update lead status details
// $type->type = $request->type;
// $type->label_color = $request->label_color;
// $type->priority = $request->priority;
// $type->save();
        //sakdjbf

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
