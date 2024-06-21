<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\LeadboardController;
use App\Http\Controllers\LeadStatusSettingController;
use App\Http\Controllers\EmailTemplateController;
use App\Http\Controllers\EmailSendController;
use App\Http\Controllers\MassageDashboardController;
use App\Models\LeadStatus;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TwilioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// routes/web.php

// routes/web.php





Route::get('/', function () {
    $dynamicStatusId = LeadStatus::first()->id;
    return view('landingpage.welcome', compact('dynamicStatusId'));
    // return view('landingpage.welcome');
});

Route::get('/store-visitor', [VisitorController::class, 'store']);
Route::post('/submit-form', [LeadController::class, 'submitForm'])->name('submit-form');
Route::get('/admin', function () {
    return Redirect::to('/admin/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';



// Admin
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::namespace('Auth')->middleware('guest:admin')->group(function () {
        // login route
        Route::get('login', 'AuthenticatedSessionController@create')->name('login');
        Route::post('login', 'AuthenticatedSessionController@store')->name('adminlogin');
    });
    Route::middleware('admin')->group(function () {
        Route::get('dashboard', 'HomeController@index')->name('dashboard');

        Route::get('admin-test', 'HomeController@adminTest')->name('admintest');
        Route::get('editor-test', 'HomeController@editorTest')->name('editortest');

        Route::resource('posts', 'PostController');
        Route::get('/lead', [LeadController::class, 'index'])->name('leads.index');
        Route::delete('/lead/{id}', [LeadController::class, 'destroy'])->name('leads.destroy');
        Route::get('/lead/{id}/edit', [LeadController::class, 'edit'])->name('leads.edit');
        Route::post('/lead/update/{id}', [LeadController::class, 'update'])->name('leads.update');
        Route::post('/lead/deleteAll', [LeadController::class, 'deleteAll'])->name('leads.deleteAll');
        Route::get('/lead/archived', [LeadController::class, 'archived'])->name('leads.archived');
        Route::get('/lead/restore/{id}', [LeadController::class, 'restore'])->name('leads.restore');
        Route::delete('/lead/delete/{id}', [LeadController::class, 'delete'])->name('leads.delete');
        Route::post('/lead/permanentdeleteAll', [LeadController::class, 'permanentdeleteAll'])->name('leads.permanentdeleteAll');


        Route::post('/email-send', [EmailSendController::class, 'index'])->name('emails.index');
        Route::post('/email-send/sendEmails', [EmailSendController::class, 'sendEmails'])->name('emails.sendEmails');


        Route::get('/leadboards', [LeadBoardController::class, 'index'])->name('leadboard');
        // Route::get('/leadboards',[LeadBoardController::class,'index'])->name('leadboard');

        Route::post('leadboards/updateIndex', [LeadBoardController::class, 'updateIndex'])->name('leadboards.update_index');
        Route::post('leadboards/update-priority', [LeadBoardController::class, 'updatePriority'])->name('leadboards.updatePriority');
        Route::get('/lead-status-settings', [LeadStatusSettingController::class, 'create'])->name('lead-status.create');
        Route::post('/lead-status-settings', [LeadStatusSettingController::class, 'store'])->name('lead-status.store');
        Route::get('/lead-status-settings/{id}/edit', [LeadStatusSettingController::class, 'edit'])->name('lead-status.edit');
        Route::post('/lead-status-settings/{id}', [LeadStatusSettingController::class, 'update'])->name('lead-status.update');
        Route::delete('/lead-status-settings/{id}', [LeadStatusSettingController::class, 'destroy'])->name('lead-status.destroy');


        Route::get('/email-templates', [EmailTemplateController::class, 'index'])->name('email.index');
        Route::get('/email-templates/create', [EmailTemplateController::class, 'create'])->name('email.create');
        Route::post('/email-templates', [EmailTemplateController::class, 'store'])->name('email.store');
        Route::delete('/email-templates/{id}', [EmailTemplateController::class, 'destroy'])->name('email.destroy');
        Route::post('/email-templates/deleteAll', [EmailTemplateController::class, 'deleteAll'])->name('email.deleteAll');
        Route::get('/email-templates/{id}/edit', [EmailTemplateController::class, 'edit'])->name('email.edit');
        Route::put('/email-templates/{id}', [EmailTemplateController::class, 'update'])->name('email.update');
        // Route::resource('lead-status-settings', LeadStatusSettingController::class);






        Route::get('/massage/dashboard', [MassageDashboardController::class, 'index'])->name('massage.index');
        Route::get('/form', [MassageDashboardController::class, 'showForm'])->name('show.form');
        Route::post('/massage-submit-form', [MassageDashboardController::class, 'massageSubmitForm'])->name('massageSubmitForm');




        // routes/web.php

        Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/create', [MessageController::class, 'create'])->name('messages.create');
        Route::post('/messages/store', [MessageController::class, 'store'])->name('messages.store');
        Route::get('/messages/{id}', [MessageController::class, 'show'])->name('messages.show');
        Route::get('/messages/{id}/edit', [MessageController::class, 'edit'])->name('messages.edit');
        Route::put('/messages/{id}', [MessageController::class, 'update'])->name('messages.update');
        Route::delete('/messages/{id}', [MessageController::class, 'destroy'])->name('messages.destroy');



        // Route::get('/make-call', [TwilioController::class, 'makeCall'])->name('call.make-call');
        // Route::post('/voice', [TwilioController::class, 'voiceResponse'])->name('twilio.voice');


        // Route::get('/make-call', [TwilioController::class, 'showMakeCallForm'])->name('call.show-make-call-form');  //imptant link
        // Route::post('/make-call', [TwilioController::class, 'makeCall'])->name('make-call'); //imptant link
        // Route::post('/twiml', [TwilioController::class, 'generateTwiML'])->name('twiml');
        // Route::post('/handle-response', [TwilioController::class, 'handleResponse'])->name('handle-response');

        // Route::post('/twiml', [TwilioController::class, 'generateTwiML'])->name('twiml');
        // Route::post('/handle-incoming-call', [TwilioController::class, 'handleIncomingCall'])->name('call.handle-incoming-call');

        
        // Route::get('/recorded-calls/{phoneNumber}', [TwilioController::class, 'showRecordedCalls'])->name('show-recorded-calls');

        // Route::get('/recorded-callsss/{phoneNumber}', [TwilioController::class, 'showRecordedCallsWithRecordings'])->name('show-recorded-calls-with-recordings');
        // Route::get('/download-recording', [TwilioController::class, 'downloadRecording'])->name('download-recording');



        // new 

    
        Route::get('/twilio/call-form', [TwilioController::class, 'showCallForm'])->name('twilio.callForm');
        Route::get('/twilio/make-call', [TwilioController::class, 'makeCall'])->name('twilio.makeCall');
        // Route::post('/twilio/connect-to-agent', [TwilioController::class, 'connectToAgent'])->name('twilio.connectToAgent');
        Route::match(['get', 'post'], '/twilio/connect-to-agent', [TwilioController::class, 'connectToAgent'])->name('twilio.connectToAgent');
        Route::get('/twilio/handle-call', [TwilioController::class, 'handleCall'])->name('twilio.handleCall');
        Route::post('/twilio/status-callback', [TwilioController::class, 'statusCallback'])->name('twilio.statusCallback');




                // web.php or api.php

        Route::post('/twilio/endCall', [TwilioController::class, 'endCall'])->name('twilio.endCall');
        Route::post('/twilio/muteCall', [TwilioController::class, 'muteCall'] )->name('twilio.muteCall');
        Route::post('/twilio/holdCall', [TwilioController::class, 'holdCall'] )->name('twilio.holdCall');


    });
    Route::post('logout', 'Auth\AuthenticatedSessionController@destroy')->name('logout');
});


Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});
