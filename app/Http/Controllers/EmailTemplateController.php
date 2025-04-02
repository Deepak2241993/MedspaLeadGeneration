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


        if (is_array($result) && isset($result['status'])) {
            if ($result['status'] == "success") {
                $data = $result['data'];


                if (empty($data)) {
                    $message = 'No data found.';
                } else {

                    usort($data, function ($a, $b) {

                        return strtotime($b['updated_on']) - strtotime($a['updated_on']);
                    });
                    $message = null;
                }

                return view('email-template.index', compact('data', 'message'));
            } else {

                $error_message = 'No Email Template Available';
                return view('email-template.index', compact('error_message'));
            }
        } else {

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
        // Check if API call was successful
        if (isset($result['status']) && $result['status'] == 'error') {
            // Handle API error
            return redirect()->route('email.index')->with('imperialheaders_success', $result['responseMessage']);
        } else {
            // API call was successful
            return redirect()->route('email.index')->with('imperialheaders_success', "Email Template Created Successfully ");
        }
    }
    public function edit($id)
        {
            $api = new CommonModel();
            $emailtemp = $api->getAPI('email_template/edit/' . $id);
            return view('email-template.edit')->with('emailtemp', $emailtemp);
        }
        
    public function update(Request $request, $id)
        {
            $api = new CommonModel();
            $data_arr = $request->except('_token', '_method');
            $data_arr['_id'] = $id;
            $data = json_encode($data_arr);
            $apiResult = $api->postAPI("email_template/update", $data);
            if ($apiResult && $apiResult['status'] === 'success') {
                return redirect()->route('email.index')->with('imperialheaders_success', 'Email Template Updated Successfully');
            } else {
                $errorMessage = $apiResult['message'] ?? 'Failed to update email template via API';
                return redirect()->route('email.edit', $id)->with('error', $errorMessage);
            }
    }


    public function destroy($id, CommonModel $api)
    {


        $result = $api->postAPI("email_template/delete/{$id}", []);

        if (isset($result['status']) && $result['status'] == 'error') {
            // Handle API error
            return redirect()->route('email.index')->with('imperialheaders_success', $result['responseMessage']);
        } else {
            // API call was successful
            return redirect()->route('email.index')->with('imperialheaders_success', 'Email Template Deleted Successfully');
        }
    }
}
