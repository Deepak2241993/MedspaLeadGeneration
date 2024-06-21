<?php

namespace App\Http\Controllers;

use App\Models\EmailTemplate;
use App\Models\LeadData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class EmailSendController extends Controller
{
    public function index(Request $request)
{
    // Validate the 'selectedIds' parameter as an array of existing lead_data IDs
    $request->validate([
        'selectedIds' => 'required|array|distinct',
        'selectedIds.*' => 'exists:lead_data,id',
    ]);

    $selectedIds = $request->input('selectedIds');

    $idsArray = array_map('intval', explode(',', $selectedIds[0]));

    // Finding emails for the extracted IDs With unique emails
    $emails = LeadData::whereIn('id', $idsArray)->pluck('email')->unique();

    // print_r($emails); die;

    // Print or use the emails as needed
    $emailTemplates = EmailTemplate::where('status', 1)->get();

    // Pass the emails and email templates data to the view
    return view('admin.emails.index', compact('emails', 'emailTemplates'));
}


    public function sendEmails(Request $request)
{

  



    $data = $request->validate([

        'to' => 'required|string', // Assuming 'to' is a comma-separated string of email addresses
        'subject' => 'nullable|string',
        'selectedTemplate' => 'required|numeric',
        'html_code' => 'nullable|string',

    ]);

    $toAddresses = explode(',', rtrim($data['to'], ','));

    if ($data['selectedTemplate'] > 0){

        $emailTemplate = EmailTemplate::find($data['selectedTemplate']);
        if ($emailTemplate) {
            // Use the data from the selected template
            $data['subject'] = $emailTemplate->subject;
            $data['html_code'] = $emailTemplate->html_code;
        }
        dd($data['subject']);
    }

    dd($toAddresses);











    try {
        $data = $request->validate([
            'to' => 'required|string', // Assuming 'to' is a comma-separated string of email addresses
            'subject' => 'nullable|string',
            'selectedTemplate' => 'required|numeric',
            'html_code' => 'nullable|string',
        ]);

        $toAddresses = explode(',', rtrim($data['to'], ','));

        $htmlCode = $data['html_code'];

        // dd($data); die;

        // Check if a template is selected
        if ($data['selectedTemplate'] > 0) {
            // Fetch the selected email template from the database
            $emailTemplate = EmailTemplate::find($data['selectedTemplate']);

            if ($emailTemplate) {
                // Use the data from the selected template
                $data['subject'] = $emailTemplate->subject;
                $data['html_code'] = $emailTemplate->html_code;
            }
        }

        // Send email to each address
        foreach ($toAddresses as $toAddress) {

            // Ensure separate variables for each email address
            $subject = $data['subject'];
            $selectedTemplate = $data['selectedTemplate'];
            $htmlCode = $data['html_code'];
            // dd($htmlCode); die;

            Mail::to(trim($toAddress))->send(new \App\Mail\YourEmailTemplate($toAddress,$subject, $selectedTemplate, $htmlCode));
        }

        return redirect()->route('admin.leads.index')->with('success', 'Emails sent successfully');
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json(['error' => $e->validator->errors()->first()], 422);
    } catch (\Exception $e) {
        // Handle other exceptions
        return response()->json(['error' => $e->getMessage()], 500);
    }
}





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
