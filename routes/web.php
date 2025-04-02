<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\CustomPasswordResetController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\LeadBoardController;
use App\Http\Controllers\LeadStatusSettingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TwilioController;
use App\Http\Controllers\EmailTemplateController;
use App\Http\Controllers\EmailSendController;
use App\Http\Controllers\CallController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserController;
use App\Events\CallEnded;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\UniqueChatController;
use App\Models\UniqueConversation;
use App\Events\UniqueMessageSent;
use App\Events\FacebookMessageSent;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();


// Handle the password reset form submission
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/', function () {
    $dynamicStatusId = "To Do";
    return view('mainform', compact('dynamicStatusId'));
    // return view('landingpage.welcome');
});
Route::get('/puser', function () {
    return view('puser');
});

Route::get('/test-broadcast', function () {
    $callSid = 'Test Call SID ' . rand(1000, 9999);
    Log::info("Broadcasting CallEnded event with Call SID: {$callSid}"); // Log the SID
    broadcast(new CallEnded($callSid));
    return "Event has been broadcasted with Call SID: {$callSid}";
});


Route::post('/check-phone-number', [LeadController::class, 'checkPhoneNumber'])->name('check.phone.number');

Route::post('/messages/receive', [MessageController::class, 'receiveMessage']);


// Outbound call (From Application To User)
Route::post('/twilio/outbound-call', [CallController::class, 'outboundCall'])->name('twilio.outbound-call');
Route::post('/twilio/user-gather', [CallController::class, 'userGather'])->name('twilio.user-gather');
Route::post('/twilio/end-call', [CallController::class, 'endCall'])->name('twilio.end-call');
Route::post('/twilio/call-status', [CallController::class, 'handleCallStatus'])->name('twilio.call-status');
Route::post('/twilio/connect-client', [CallController::class, 'connectClient'])->name('twilio.connect-client');
Route::post('/twilio/recording-status', [CallController::class, 'handleRecordingStatus'])->name('twilio.handle-recording-status');
Route::post('/twilio/recording-status-callback', [CallController::class, 'handleRecordingStatus'])->name('twilio.recording-status');

//incoming call from users
Route::post('/twilio/inbound-call', [CallController::class, 'handleIncomingCall']);
Route::post('/twilio/handle-gather', [CallController::class, 'handleGather']);
Route::post('/twilio/handle-busy', [CallController::class, 'handleBusy'])->name('twilio.handleBusy');
Route::post('/twilio/handle-waiting', [CallController::class, 'handleWaiting'])->name('twilio.handleWaiting');
Route::post('/twilio/handle-recording-status', [CallController::class, 'incomingHandleRecordingStatus']);
Route::post('/twilio/fallback', [CallController::class, 'fallback']);
Route::post('/twilio/recording-status', [CallController::class, 'incomingHandleRecordingStatus'])->name('twilio.recording-status');



Route::post('/emails/send', [EmailSendController::class, 'sendEmails'])->name('emails.send');


Route::post('/submit-form', [LeadController::class, 'submitForm'])->name('submit-form');

Route::get('/roles', function () {
    // Your route logic here
})->middleware('super_admin');


Route::middleware(['isAdmin'])->group(function () {
    Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('super-admin.dashboard');

    // Role and Permission routes
    Route::resource('roles', RolePermissionController::class);
    Route::get('roles/{role}/give-permissions', [RolePermissionController::class, 'addPermissionToRole'])->name('roles.give-permissions');
    Route::post('moduleUpdate/{id}', [RolePermissionController::class, 'moduleUpdate'])->name('roles.moduleUpdate');

    // Additional routes for managing permissions if needed
    Route::get('permissions', [PermissionController::class, 'permissionsIndex'])->name('role-permission.permissions.index');
    Route::get('permissions/create', [PermissionController::class, 'createPermission'])->name('permissions.create');
    Route::post('permissions', [PermissionController::class, 'storePermission'])->name('permissions.store');
    Route::get('permissions/{id}/edit', [PermissionController::class, 'editPermission'])->name('permissions.edit');
    Route::put('permissions/{id}', [PermissionController::class, 'updatePermission'])->name('permissions.update');
    Route::delete('permissions/{id}', [PermissionController::class, 'destroyPermission'])->name('permissions.destroy');

    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::get('users/{userId}/delete', [UserController::class, 'destroy']);
});


Route::middleware(['auth'])->group(function () {


    Route::get('/dashboard', [HomeController::class, 'root'])->name('dashboard');





    Route::get('/profile', [HomeController::class, 'profile'])->name('pages-profile');
    Route::put('/profile/update', [HomeController::class, 'updateProfile'])->name('profile.update');
    Route::get('/settings', [HomeController::class, 'settingView'])->name('settings');
    // Route for password update
    Route::post('/settings/password', [HomeController::class, 'updatePassword'])->name('password.update');



    // Add other super admin routes here
    Route::get('/lead', [LeadController::class, 'index'])->name('leads.index');
    Route::get('/lead/{id}/edit', [LeadController::class, 'edit'])->name('leads.edit');
    Route::post('/lead/update/{id}', [LeadController::class, 'update'])->name('leads.update');
    Route::delete('/lead/{id}', [LeadController::class, 'destroy'])->name('leads.destroy');
    Route::get('/create/lead', [LeadController::class, 'create'])->name('leads.create');
    Route::post('/create', [LeadController::class, 'store'])->name('leads.store');
    Route::get('leads/export', [LeadController::class, 'exportLeadsCsv'])->name('leads.export');
    Route::get('/export-headers', [LeadController::class, 'exportHeadersOnly'])->name('export.headers');
    Route::post('/leads/import', [LeadController::class, 'importLeads'])->name('leads.import');

    //multi delete
    Route::delete('/leads', [LeadController::class, 'destroyMultiple'])->name('leads.destroyMultiple');


    // Archived leads
    Route::get('/archived', [LeadController::class, 'archived'])->name('leads.archived');
    Route::get('/restore/{id}', [LeadController::class, 'restore'])->name('leads.restore');
    Route::post('/restore-multiple', [LeadController::class, 'restoreMultiple'])->name('leads.restoreMultiple');
    Route::delete('/permanentdelete/{id}', [LeadController::class, 'permanentdelete'])->name('leads.permanentdelete');

    // Leadboard
    Route::get('/leadboards', [LeadBoardController::class, 'index'])->name('leadboard');
    Route::post('leadboards/updateIndex', [LeadBoardController::class, 'updateIndex'])->name('leadboards.update_index');
    Route::post('leadboards/updateAssignee', [LeadBoardController::class, 'updateAssignee'])->name('leadboards.update_assignee');

    // Lead status settings
    // Route::get('/lead-status-settings', [LeadStatusSettingController::class, 'create'])->name('lead-status.create');
    Route::post('/lead-status-settings', [LeadStatusSettingController::class, 'store'])->name('lead-status.store');
    // Route::get('/lead-status-settings/{id}/edit', [LeadStatusSettingController::class, 'edit'])->name('leadstatus.edit');
    Route::post('/lead-status-settings/update', [LeadStatusSettingController::class, 'update'])->name('lead-status.update');
    Route::post('/lead-status-settings/{id}', [LeadStatusSettingController::class, 'destroy'])->name('lead-status.destroy');

    // Email templates
    Route::get('/email-templates', [EmailTemplateController::class, 'index'])->name('email.index');
    Route::get('/email-templates/create', [EmailTemplateController::class, 'create'])->name('email.create');
    Route::post('/email-templates', [EmailTemplateController::class, 'store'])->name('email.store');
    Route::delete('/email-templates/{id}', [EmailTemplateController::class, 'destroy'])->name('email.destroy');
    Route::post('/email-templates/deleteAll', [EmailTemplateController::class, 'deleteAll'])->name('email.deleteAll');
    Route::get('/emailtemplates/edit/{id}', [EmailTemplateController::class, 'edit'])->name('email.edit');
    Route::put('/email-templates/{id}', [EmailTemplateController::class, 'update'])->name('email.update');

    Route::post('/lead/permanentdeleteAll', [LeadController::class, 'permanentdeleteAll'])->name('leads.permanentdeleteAll');

    //Email Send 
    Route::post('/emails', [EmailSendController::class, 'index'])->name('emails.index');
    Route::post('/emails/send', [EmailSendController::class, 'sendEmails'])->name('emails.send');

    // Twilio integration
    Route::post('/make-call', [TwilioController::class, 'makeCall'])->name('make-call');
    Route::post('/hold-call', [TwilioController::class, 'holdCall'])->name('hold-call');
    Route::match(['get', 'post'], '/connect-to-agent', [TwilioController::class, 'connectToAgent'])->name('connectToAgent');
    Route::match(['get', 'post'], '/handle-call', [TwilioController::class, 'handleCall'])->name('handleCall');
    Route::post('/status-callback', [TwilioController::class, 'statusCallback'])->name('statusCallback');
    Route::post('status-callback', [TwilioController::class, 'callStatusCallback'])->name('callStatusCallback');
    Route::get('/get-call-duration', [TwilioController::class, 'getCallDuration'])->name('get-call-duration');



    // Mess
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/load-more-leads', [MessageController::class, 'loadMoreLeads']);
    Route::post('/messages/send', [MessageController::class, 'sendMessage'])->name('messages.send');
    // Route::post('/messages/receive', [MessageController::class, 'receiveMessage'])->name('messages.receive');
    // Route::post('/messages/receive', [MessageController::class, 'receiveMessage'])->name('messages.receive');
    // Route::post('/messages/receive', [MessageController::class, 'receiveMessage'])->middleware('auth');

    Route::get('/sendPusher', [MessageController::class, 'sendpusher'])->name('messages.sendPusher');
    Route::get('/get-messages/{currentUserPhone}', [MessageController::class, 'getMessages'])->name('messages.getMessages');

    // Unique Conversation
    Route::get('/unique-chat-dashboard', [UniqueChatController::class, 'dashboard'])->name('unique-chat-dashboard');
    Route::get('/instagram-unique-chat-dashboard', [UniqueChatController::class, 'instagramdashboard'])->name('instagram-unique-chat-dashboard');
    Route::get('/unique-conversations', [UniqueChatController::class, 'getConversations']);
    Route::get('/unique-messages/{conversationId}', [UniqueChatController::class, 'getMessages']);
    Route::post('/unique-send-message', [UniqueChatController::class, 'sendMessage']);


    // test tinker 
    Route::get('/test-event', function () {
        event(new \App\Events\MessageReceived('+918077477522', 'vishal'));
        return 'Event dispatched!';
    });
});


Route::get('{any}', [HomeController::class, 'index'])->name('index');


Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

Route::get('/routtee', function () {
    $exitCode = Artisan::call('optimize:clear');
    return 'DONE CLEAR';
});
