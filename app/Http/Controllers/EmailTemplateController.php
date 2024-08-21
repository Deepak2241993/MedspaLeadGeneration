<?php

namespace App\Http\Controllers;

use App\Models\CommonModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmailTemplateController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:email-template_view',['only' => ['index']]);
        $this->middleware('permission:email-template_create',['only' => ['create', 'store']]);
        $this->middleware('permission:email-template_edit',['only' => ['edit','update']]);
        $this->middleware('permission:email-template_delete',['only' => ['destroy']]);

    }
    public function index(Request $request)
    {
        $api = new CommonModel();
        $result = $api->getAPI('email_template/list');
        // dd($result);

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

                return view('email-template.index', compact('data', 'message'));
            } else {
                // Handle the case where API call was successful but status is not "success"
                $error_message = 'Failed to retrieve leads.';
                return view('email-template.index', compact('error_message'));
            }
        } else {
            // Handle the case where $result is null or not an array (API call failed)
            $error_message = 'Failed to retrieve data from API.';
            return view('email-template.index', compact('error_message'));
        }
    }
    public function create(Request $request)
    {
        return view('email-template.create');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $api = new CommonModel();

        // Extract data from the request
        $title = $request->title;
        $html_code = $request->area;
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
        // Check if API call was successful
        if (isset($result['status']) && $result['status'] == 'error') {
            // Handle API error
            return redirect()->route('email.index')->with('imperialheaders_success', $result['responseMessage']);
        } else {
            // API call was successful
            return redirect()->route('email.index')->with('imperialheaders_success', $result['responseMessage']);
        }
    }
    public function edit($id)
    {
        // dd($id);
        $api = new CommonModel();
        $emailtemp = $api->getAPI('emailtemplate/edit/' . $id);
        return view('email-template.edit')->with('emailtemp', $emailtemp);
    }
    public function update(Request $request, $id)
    {
        // $emailTemplate = EmailTemplate::findOrFail($id);
        // $emailTemplate->update($request->all());

        return back()->with('success', 'Email Template updated successfully');
    }


    public function destroy($id, CommonModel $api)
    {


        $result = $api->postAPI("email_template/delete/{$id}", []);

        if (isset($result['status']) && $result['status'] == 'error') {
            // Handle API error
            return redirect()->route('email.index')->with('imperialheaders_success', $result['responseMessage']);
        } else {
            // API call was successful
            return redirect()->route('email.index')->with('imperialheaders_success', $result['responseMessage']);
        }
    }
}
