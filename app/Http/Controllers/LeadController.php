<?php

namespace App\Http\Controllers;

use App\Models\LeadData;
use App\Models\LeadStatus;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\CommonModel;

class LeadController extends Controller
{


    public function submitForm(Request $request)
    {
        $api = new CommonModel();
        $data_arr = $request->except('_token');
        $data_arr['source'] = 'Facebook';
        $data = json_encode($data_arr);
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
    // public function submitForm(Request $request)
    // {
    //     $api = new CommonModel();
    //     $data_arr = $request->except('_token');
    
    //     // Combine the country code and phone number
    //     $fullPhoneNumber = $data_arr['countryCode'] . $data_arr['phone'];

        
    //     // Assign the combined phone number to the 'phone' key in the data array
    //     $data_arr['phone'] = $fullPhoneNumber;
        
    //     unset($data_arr['countryCode']);
    //     $data_arr['source'] = 'Facebook';
    //     $data = json_encode($data_arr);

    //     dd($data);
    //     $result = $api->postAPI('lead/capture', $data);
    

    //     if (isset($result['status']) && $result['status'] == 'error') {
    //         return back()->with('imperialheaders_success', $result['responseMessage']);
    //     } else {
    //         return back()->with('imperialheaders_success', $result['responseMessage']);
    //     }
    // }


    public function submitForm1(Request $request)
    {
        // Validate the form data
        $request->validate([
            'fname' => 'required|max:50',
            'lname' => 'required|max:50',
            'phone' => 'required|numeric',
            'message' => 'required|min:2',
            'mobile' => 'nullable|numeric',
            'status_id' => 'required|exists:lead_status,id',
            // Add validation rules for other fields as needed
        ]);
        $fullName = $request->input('fname') . ' ' . $request->input('lname');

        // Create a new instance of LeadData and fill it with form data
        $formData = new LeadData([
            'name' => $fullName,
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'message' => $request->input('message'),
        ]);
        // Associate the status with the LeadData
        $formData->status()->associate($request->input('status_id'));

        // Save the form data to the database
        $formData->save();

        return back()->with('imperialheaders_success', 'Form submitted successfully!');
    }

    public function index(Request $request)
{
    if ($request->ajax()) {
        // Make an API request
        $api = new CommonModel();
        $result = $api->getAPI('lead/list/0');
        
        // Handle the API response
        if ($result['status'] == "success") {
            // Process $result['data'] as needed
            $leaddata = collect($result['data']);
            
            return DataTables::of($leaddata)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    // Check if the row has an "_id" property before accessing it
                    $id = isset($row['_id']) ? $row['_id'] : null;

                    return '<input type="checkbox" class="row-checkbox" data-id="' . $id . '">';
                })
                ->addColumn('action', function ($row) {
                    $id = isset($row['_id']) ? $row['_id'] : null;
                    $phone = isset($row['phone']) ? $row['phone'] : '';
                    
                    $editBtn = '<a href="' . url("admin/lead") . '/' . $id . '/edit" class="edit btn btn-primary btn-sm">Edit</a>';
                    $deleteBtn = '<button type="button" class="delete btn btn-danger btn-sm" data-id="' . $id . '">Delete</button>';
                    // $callBtn = '<a href="' . route('admin.twilio.makeCall', ['number' => $row['phone']]) . '" class="edit btn btn-primary btn-sm"><i class="fa fa-phone"></i></a>';
                    // $callBtn = '<button class="btn btn-primary btn-sm btn-make-call"><i class="fa fa-phone"></i></button>';
                    $callBtn = '<button class="btn btn-primary btn-sm btn-make-call" data-id="' . e($id) . '" data-number="' . e($phone) . '"><i class="fa fa-phone"></i></button>';

                    $messageBtn = '<button type="button" class="btn btn-primary btn-sm" data-id="' . $id . '"><i class="fa fa-envelope"></i></button>';
                    
                    return '<div class="checkbox-action">' . $editBtn . ' | ' . $callBtn . ' | ' . $messageBtn . ' | ' . $deleteBtn . '</div>';
                })
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        } else {
            // Handle API error
            dd($result['error']);
        }
    }

    return view('admin.leads.index');
}

    public function index1(Request $request)
    {
        if ($request->ajax()) {
            $leaddata = LeadData::where('view', '1')->get();
            $statusIds = $leaddata->pluck('status_id')->unique();
            $status = LeadStatus::whereIn('id', $statusIds)->get();

            // dd($status);

            $formattedData = $leaddata->map(function ($item) {
                $item->created_at = $item->created_at->toDateString(); // Format date as 'Y-m-d'
                return $item;
            });

            return DataTables::of($leaddata)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    return '<input type="checkbox" class="row-checkbox" data-id="' . $row->id . '">';
                })
                ->addColumn('status', function ($row) use ($status) {
                    foreach ($status as $st) {
                        if ($row->status_id == $st->id) {
                            $action = $st->type;
                        }
                    }
                    //  dd($action);
                    return $action;
                })

                ->addColumn('action', function ($row) {
                    $editBtn = '<a href="' . url("admin/lead") . '/' . $row->id . '/edit" class="edit btn btn-primary btn-sm">Edit</a>';
                    $deleteBtn = '<button type="button" class="delete btn btn-danger btn-sm" data-id="' . $row->id . '">Delete</button>';

                    return '<div class="checkbox-action">' . $editBtn . ' | ' . $deleteBtn . '</div>';
                })
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }

        return view('admin.leads.index');
    }

    public function destroy($id)
    {
        // Create a new instance of the CommonModel
        $api = new CommonModel();

        // Use the correct API endpoint for deletion
        $result = $api->postAPI('lead/archive/' . $id, []);

        // dd($result) ;// Provide an empty array or any necessary data if required

        // Check if the API request was successful
        if ($result['status'] !== 'success') {
            // Log the API error for debugging
            \Log::error('API request failed: ' . json_encode($result));

            // Redirect to an error page with a generic message
            return response()->json(['error' => 'Error deleting lead'], 500);
        }

        // Return a success response
        return response()->json(['message' => 'Lead deleted successfully'], 200);
    }


    public function edit($id)
    {
        $api = new CommonModel();
        $result = $api->getAPI('lead/view/' . $id);
        // dd($result);

        // Check if the API request was successful
        if ($result['status'] === 'success') {

            // dd($result);
            // Check if the lead is found
            if ($result !== null) {
                // Lead found, proceed to view
                return view('admin.leads.edit', compact('result'));
            } else {
                // Lead not found for the specified $id
                return redirect()->route('error.page')->with('error', 'Lead not found');
            }
        } else {
            // API request failed, handle the error
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

        // Convert data array to JSON
        $data = json_encode($data_arr);




        // Assuming postAPI returns the API response as an associative array
        $apiResult = $api->postAPI("lead/update", $data);



        // Check if the API call was successful based on the API response
        if ($apiResult && $apiResult['status'] === 'success') {
            return redirect()->route('admin.leads.index')->with('success', 'Lead updated successfully');
        } else {
            // Handle the case where the API call did not return success
            return redirect()->route('admin.leads.index')->with('error', 'Failed to update lead via API');
        }
    }



    public function updateStatus(Request $request)
    {
        // dd('heello');
        $ids = $request->input('ids');
        // $newStatus = 'archived'; // Change 'archived' to the desired status

        try {
            // Assuming you have a 'status' column in your 'emails' table
            LeadData::whereIn('id', $ids)->update(['view' => 0]);

            return response()->json(['message' => 'Selected items updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating items'], 500);
        }
    }


    // Email Send
    public function sendEmails(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'ids' => 'required|array',
                'ids.*' => 'exists:lead_data,id',
            ]);

            $ids = $request->input('ids');

            print_r($ids);
            die;

            // Retrieve email addresses for the selected IDs
            $emails = LeadData::whereIn('id', $ids)->pluck('email')->toArray();

            // print_r($emails); die;

            // Send emails to the retrieved email addresses
            foreach ($emails as $email) {
                // Add your email sending logic here
                Mail::to($email)->send(new \App\Mail\YourEmailTemplate());
            }

            return response()->json(['message' => 'Emails sent successfully']);
        } catch (\Exception $e) {
            // Handle exceptions if any
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function getData()
    {
        $columns = [
            'DT_RowIndex', 'name', 'email', 'phone', 'message', 'status'
        ];

        $query = LeadData::query();

        // Handle global search
        if (request()->has('search.value')) {
            $query->where('name', 'like', '%' . request('search.value') . '%')
                ->orWhere('email', 'like', '%' . request('search.value') . '%')
                ->orWhere('phone', 'like', '%' . request('search.value') . '%')
                ->orWhere('message', 'like', '%' . request('search.value') . '%')
                ->orWhere('status', 'like', '%' . request('search.value') . '%');
        }

        $data = $query->get($columns);

        // Format data for DataTables
        $formattedData = [];
        foreach ($data as $index => $row) {
            $formattedData[] = [
                'checkbox' => '', // Add your checkbox HTML here
                'DT_RowIndex' => $index + 1,
                'name' => $row->name,
                'email' => $row->email,
                'phone' => $row->phone,
                'message' => $row->message,
                'status' => $row->status,
            ];
        }

        return response()->json([
            'draw' => request('draw'),
            'recordsTotal' => LeadData::count(),
            'recordsFiltered' => $query->count(),
            'data' => $formattedData,
        ]);
    }
    public function archived(Request $request)
    {
        if ($request->ajax()) {
            try {
                // Make an API request
                $api = new CommonModel();
                $result = $api->getAPI('lead/list/1');

                if ($result['status'] == "success") {
                    // Process $result['data'] as needed
                    $leaddata = collect($result['data']);

                    return DataTables::of($leaddata)
                        ->addIndexColumn()
                        ->addColumn('checkbox', function ($row) {
                            $id = isset($row['_id']) ? $row['_id'] : null;

                            return '<input type="checkbox" class="row-checkbox" data-id="' . $id . '">';
                        })
                        ->addColumn('action', function ($row) {
                            $id = isset($row['_id']) ? $row['_id'] : null;
                            // dd($id);
                            $restoreBtn = '<a href="' . url("admin/lead/restore") . '/' . $id . '" class="restore btn btn-primary btn-sm">Restore</a>';
                            $harddeleteBtn = '<button type="button" class="harddelete btn btn-danger btn-sm" data-id="' . $id . '">Delete</button>';

                            return '<div class="checkbox-action">' . $restoreBtn . ' | ' . $harddeleteBtn . '</div>';
                        })
                        ->rawColumns(['checkbox', 'action'])
                        ->make(true);
                } else {
                    // Handle API error
                    return response()->json(['error' => $result['error']], 500);
                }
            } catch (\Exception $e) {
                // Log and handle unexpected exceptions
                \Log::error('Error in archived method: ' . $e->getMessage());
                return response()->json(['error' => 'Internal Server Error'], 500);
            }
        }

        return view('admin.leads.archived');
    }

    public function archivedfff(Request $request)
    {
        if ($request->ajax()) {
            $leaddata = LeadData::where('view', '0')->get();
            $statusIds = $leaddata->pluck('status_id')->unique();
            $status = LeadStatus::whereIn('id', $statusIds)->get();

            // dd($status);

            $formattedData = $leaddata->map(function ($item) {
                $item->created_at = $item->created_at->toDateString(); // Format date as 'Y-m-d'
                return $item;
            });

            return DataTables::of($leaddata)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    return '<input type="checkbox" class="row-checkbox" data-id="' . $row->id . '">';
                })
                ->addColumn('status', function ($row) use ($status) {
                    foreach ($status as $st) {
                        if ($row->status_id == $st->id) {
                            $action = $st->type;
                        }
                    }
                    //  dd($action);
                    return $action;
                })

                ->addColumn('action', function ($row) {
                    $restoreBtn = '<a data-id="' . $row->id . '" class="restore btn btn-primary btn-sm">Restore</a>';
                    $harddeleteBtn = '<button type="button" class="harddelete btn btn-danger btn-sm" data-id="' . $row->id . '">Delete</button>';

                    return '<div class="checkbox-action">' . $restoreBtn . ' | ' . $harddeleteBtn . '</div>';
                })
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }
        return view('admin.leads.archived');
        // print_r($leaddata); die;
    }
    public function restore($id)
    {
        try {
            $api = new CommonModel();
            $result = $api->postAPI("lead/restore/{$id}", []);

            // dd($result);

            if ($result['status'] === 'success') {

                // Check if the lead is found

                // Lead found, proceed to view or perform any other necessary action
                return view('admin.leads.archived', compact('result'));
            } else {
                \Log::error('API request failed: ' . json_encode($result));
                return response()->json(['error' => 'Error restoring lead'], 500);
            }
        } catch (\Exception $e) {
            \Log::error('Exception: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }



    public function delete($id, CommonModel $api)
    {
        $result = $api->postAPI("lead/delete/{$id}", []);
    
        if ($result['status'] === 'success') {
            // Optionally, you may perform additional actions for success
            $message = 'Status updated successfully';
    
            // JSON response for success
            $jsonResponse = response()->json(['message' => $message], 200);
    
            // View response for success
            $viewResponse = view('admin.leads.archived', compact('result'));
    
            // Return both responses
            return [$jsonResponse, $viewResponse];
        } else {
            // Handle different statuses (e.g., error, not found)
            return response()->json(['error' => 'Error deleting lead'], 500);
        }
    }
    
    
    public function permanentdeleteAll(Request $request)
    {
        $ids = $request->input('ids');
        // $newStatus = 'archived'; // Change 'archived' to the desired status

        try {
            // Assuming you have a 'status' column in your 'emails' table
            LeadData::whereIn('id', $ids)->delete();
            return response()->json(['message' => 'Selected items updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating items'], 500);
        }
    }

    public function endCall(Request $request)
    {
        // Logic to end the call
        $callSid = $request->input('callSid');
        try {
            $call = $this->twilio->calls($callSid)->update(['status' => 'completed']);
            return response()->json(['success' => 'Call ended successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to end call: ' . $e->getMessage()], 500);
        }
    }

    public function muteCall(Request $request)
    {
        // Logic to mute the call
        $callSid = $request->input('callSid');
        try {
            // Add your logic to mute the call using Twilio API
            return response()->json(['success' => 'Call muted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to mute call: ' . $e->getMessage()], 500);
        }
    }

    public function holdCall(Request $request)
    {
        // Logic to hold the call
        $callSid = $request->input('callSid');
        try {
            // Add your logic to hold the call using Twilio API
            return response()->json(['success' => 'Call held successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to hold call: ' . $e->getMessage()], 500);
        }
    }
}
