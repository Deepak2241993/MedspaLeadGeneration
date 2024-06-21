<?php

namespace App\Http\Controllers;

use App\Models\LeadData;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class MassageDashboardController extends Controller
{
    Public function index(){

        $leaddata = LeadData::where('view', '1')->get();

        return view('massage.index',compact('leaddata'));
    } 
    public function showForm()
    {
        return view('massage.sendmessage');
    }

    public function massageSubmitForm(Request $request) {

        $input = $request->all();


        $sid = "AC1ed59c9572c8062d05dc1d7d12777712";
        $token = "e13ac721da86113d3e0390490601cb9f";
        $client = new Client($sid, $token);

        // Use the Client to make requests to the Twilio REST API
        $client->messages->create(
            // The number you'd like to send the message to
            $input['number'],
            [
                // A Twilio phone number you purchased at https://console.twilio.com
                'from' => '+18335302118',
                // The body of the text message you'd like to send
                'body' => $input['message']
            ]
        );
        // dd($client);

        return redirect()->route('admin.show.form')->withSuccess('Message Sent Successfully');



    }
    public function receiveSMS(Request $request)
    {
        $messageBody = $request->input('Body');
        $phoneNumber = $request->input('From');

        // do something with the message
    }
}
