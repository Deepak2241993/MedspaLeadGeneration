<?php

namespace App\Http\Controllers;

use App\Models\EmailTemplate;
use DataTables;
use Illuminate\Http\Request;
use App\Models\CommonModel;

class EmailTemplateController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $api = new CommonModel();
            $result = $api->getAPI('email_template/list');

            if ($result['status'] == "success") {
                $emailTemplate = collect($result['data']);

                return DataTables::of($emailTemplate)
                    ->addIndexColumn()
                    // ->addColumn('status', function ($row) {
                    //     $id = isset($row['_id']) ? $row['_id'] : null;
                    //     $checked = $row->status ? ' checked' : '';
                    //     return '<input type="checkbox" data-toggle="toggle" data-size="mini" data-id="' . $id . '"' . $checked . '>';
                    // })
                    ->addColumn('action', function ($row) {
                        $id = isset($row['_id']) ? $row['_id'] : null;
                        $editBtn = '<a href="' . url("admin/email-templates") . '/' . $id . '/edit" class="edit btn btn-primary btn-sm">Edit</a>';
                        $deleteBtn = '<button type="button" class="delete btn btn-danger btn-sm" data-id="' . $id . '">Delete</button>';
                        return $editBtn . ' | ' . $deleteBtn;
                    })
                    ->rawColumns(['status', 'action'])
                    ->make(true);
            } else {
                // Handle API error gracefully
                return response()->json(['error' => $result['error']], 500);
            }
        }

        return view('admin.email-template.index');
    }

    // public function index(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $api = new CommonModel();
    //         $result = $api->getAPI('email_template/list');

    //         // dd($data);


    //         if ($result['status'] == "success") {
    //             // Process $result['data'] as needed
    //             $emailTemplate = collect($result['data']);
    //             // dd($leaddata);
    //             return DataTables::of($emailTemplate)
    //             ->addIndexColumn()
    //             ->addColumn('status', function ($row) {
    //                 $id = isset($row['_id']) ? $row['_id'] : null;
    //                 // Assuming 'status' is a boolean field in your EmailTemplate model
    //                 $statusToggle = '<input type="checkbox" data-toggle="toggle" data-size="mini" data-id="' . $id . '"';

    //                 // Set the initial state based on the 'status' column value
    //                 if ($row->status) {
    //                     $statusToggle .= ' checked';
    //                 }

    //                 $statusToggle .= '>';

    //                 return $statusToggle;
    //             })
    //             ->addColumn('action', function ($row) {
    //                 $id = isset($row['_id']) ? $row['_id'] : null;
    //                 $editBtn = '<a href="' . url("admin/email-templates") . '/' . $id . '/edit" class="edit btn btn-primary btn-sm">Edit</a>';
    //                 $deleteBtn = '<button type="button" class="delete btn btn-danger btn-sm" data-id="' . $id . '">Delete</button>';

    //                 return $editBtn . ' | ' . $deleteBtn;
    //             })
    //             // ->rawColumns(['status', 'action'])
    //             ->make(true);
    //         } else {
    //             // Handle API error
    //             dd($result['error']);
    //         }

    //         // $emailtemp = EmailTemplate::latest()->get();
    //         // $formattedData = $emailtemp->map(function ($item) {
    //         //     $item->created_at = $item->created_at->toDateString(); // Format date as 'Y-m-d'
    //         //     return $item;
    //         // });

    //     }        

    //     return view('admin.email-template.index');
    // }

    public function create(Request $request)
    {
        return view('admin.email-template.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     // $maxPriority = EmailTemplate::max('priority');

    //     $status = new EmailTemplate();
    //     $status->title = $request->title;
    //     // $status->subject = $request->subject;
    //     $status->html_code = $request->html_code;
    //     $status->status = $request->status;

    //     // print_r($status); die;
    //     $status->save();

    //     return view('admin.email-template.index')->with('imperialheaders_success', 'Email Template Created Successfully!');

    // }

    public function store(Request $request)
    {
        $api = new CommonModel();

        // Extract data from the request
        $title = $request->title;
        $html_code = $request->html_code;
        $status = $request->status;

        // Prepare data array to be sent to the API
        $data = [
            'title' => $title,
            'html_code' => $html_code,
            'status' => $status,
        ];

        // Convert data to JSON format
        $dataJson = json_encode($data);
        
        // Call the API to store the data
        $result = $api->postAPI('email_template/add', $dataJson);

        // Check if API call was successful
        if (isset($result['status']) && $result['status'] == 'error') {
            // Handle API error
            return back()->with('imperialheaders_success', $result['responseMessage']);
        } else {
            // API call was successful
            return back()->with('imperialheaders_success', $result['responseMessage']);
        }
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
        $emailtemp = EmailTemplate::findOrFail($id);
        return view('admin.email-template.edit')->with('emailtemp', $emailtemp);
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
        $emailTemplate = EmailTemplate::findOrFail($id);
        $emailTemplate->update($request->all());

        return back()->with('success', 'Email Template updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, CommonModel $api)
    {
        // $emailTemplate = EmailTemplate::find($id);

        $result = $api->postAPI("email_template/delete/{$id}", []);

        if ($result['status'] === 'success') {
            // Optionally, you may perform additional actions for success
            $message = 'Status updated successfully';
    
            // JSON response for success
            $jsonResponse = response()->json(['message' => $message], 200);
    
            // View response for success
            $viewResponse = view('admin.email-template.index', compact('result'));
    
            // Return both responses
            return [$jsonResponse, $viewResponse];
        } else {
            // Handle different statuses (e.g., error, not found)
            return response()->json(['error' => 'Error deleting lead'], 500);
        }

        // if (!$emailTemplate) {
        //     return response()->json(['error' => 'Email Template not found'], 404);
        // }

        // $emailTemplate->delete();

        // return response()->json(['message' => 'Email Template deleted successfully'], 200);
    }
    public function deleteAll(Request $request)
    {
        $ids = $request->input('ids');

        print_r($ids);
        die;
        try {
            // Assuming you have an 'id' column in your 'emails' table
            EmailTemplate::whereIn('id', $ids)->delete();

            return response()->json(['message' => 'Selected items deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting items'], 500);
        }
    }
}
