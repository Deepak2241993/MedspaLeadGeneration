<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\LeadBoardController;
use App\Http\Controllers\LeadStatusSettingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TwilioController;
use App\Http\Controllers\EmailTemplateController;
use App\Http\Controllers\CallController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\PermissionController;


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

Route::get('/roles', function () {
    // Your route logic here
})->middleware('super_admin');



Route::middleware(['superadmin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Role nd Permission routes
    Route::resource('roles', RolePermissionController::class);
    Route::get('roles/{role}/give-permissions', [RolePermissionController::class, 'addPermissionToRole'])->name('roles.give-permissions');


    // Additional routes for managing permissions if needed
    Route::get('permissions', [RolePermissionController::class, 'permissionsIndex'])->name('role-permission.permissions.index');
    Route::get('permissions/create', [RolePermissionController::class, 'createPermission'])->name('permissions.create');
    Route::post('permissions', [RolePermissionController::class, 'storePermission'])->name('permissions.store');
    Route::get('permissions/{id}/edit', [RolePermissionController::class, 'editPermission'])->name('permissions.edit');
    Route::put('permissions/{id}', [RolePermissionController::class, 'updatePermission'])->name('permissions.update');
    Route::delete('permissions/{id}', [RolePermissionController::class, 'destroyPermission'])->name('permissions.destroy');


    Route::resource('users', App\Http\Controllers\UserController::class);

    // Add other super admin routes here
    Route::get('/lead', [LeadController::class, 'index'])->name('leads.index');
    Route::get('/lead/{id}/edit', [LeadController::class, 'edit'])->name('leads.edit');
    Route::post('/lead/update/{id}', [LeadController::class, 'update'])->name('leads.update');
    Route::delete('/lead/{id}', [LeadController::class, 'destroy'])->name('leads.destroy');

    // Archived leads
    Route::get('/archived', [LeadController::class, 'archived'])->name('leads.archived');
    Route::get('/restore/{id}', [LeadController::class, 'restore'])->name('leads.restore');
    Route::delete('/delete/{id}', [LeadController::class, 'delete'])->name('leads.delete');

    // Leadboard
    Route::get('/leadboards', [LeadBoardController::class, 'index'])->name('leadboard');
    Route::post('leadboards/updateIndex', [LeadBoardController::class, 'updateIndex'])->name('leadboards.update_index');

    // Lead status settings
    Route::get('/lead-status-settings', [LeadStatusSettingController::class, 'create'])->name('lead-status.create');
    Route::post('/lead-status-settings', [LeadStatusSettingController::class, 'store'])->name('lead-status.store');
    Route::get('/lead-status-settings/{id}/edit', [LeadStatusSettingController::class, 'edit'])->name('leadstatus.edit');
    Route::put('/lead-status-settings/{id}', [LeadStatusSettingController::class, 'update'])->name('lead-status.update');
    Route::delete('/lead-status-settings/{id}', [LeadStatusSettingController::class, 'destroy'])->name('lead-status.destroy');

    // Email templates
    Route::get('/email-templates', [EmailTemplateController::class, 'index'])->name('email.index');
    Route::get('/email-templates/create', [EmailTemplateController::class, 'create'])->name('email.create');
    Route::post('/email-templates', [EmailTemplateController::class, 'store'])->name('email.store');
    Route::delete('/email-templates/{id}', [EmailTemplateController::class, 'destroy'])->name('email.destroy');
    Route::post('/email-templates/deleteAll', [EmailTemplateController::class, 'deleteAll'])->name('email.deleteAll');
    Route::get('/email-templates/{id}/edit', [EmailTemplateController::class, 'edit'])->name('email.edit');
    Route::put('/email-templates/{id}', [EmailTemplateController::class, 'update'])->name('email.update');

    Route::post('/lead/permanentdeleteAll', [LeadController::class, 'permanentdeleteAll'])->name('leads.permanentdeleteAll');

    // Twilio integration
    Route::post('/make-call', [TwilioController::class, 'makeCall'])->name('make-call');
    Route::post('/hold-call', [TwilioController::class, 'holdCall'])->name('hold-call');
    Route::match(['get', 'post'], '/connect-to-agent', [TwilioController::class, 'connectToAgent'])->name('connectToAgent');
    Route::match(['get', 'post'], '/handle-call', [TwilioController::class, 'handleCall'])->name('handleCall');
    Route::post('/status-callback', [TwilioController::class, 'statusCallback'])->name('statusCallback');
    Route::post('status-callback', [TwilioController::class, 'callStatusCallback'])->name('callStatusCallback');
    Route::get('/get-call-duration', [TwilioController::class, 'getCallDuration'])->name('get-call-duration');
    Route::post('/end-call', [TwilioController::class, 'endCall'])->name('end-call');

    // Outbound call
    Route::post('/outbound-call', [CallController::class, 'outboundCall'])->name('outbound-call');
    Route::match(['get', 'post'], '/twilio/user-gather', [CallController::class, 'userGather'])->name('twilio.user-gather');

    // Inbound call
    Route::post('/twilio/inbound-call', [TwilioController::class, 'handleIncomingCall']);
    Route::post('/handle-gather', [TwilioController::class, 'handleGather'])->name('handle-gather');

    // Record the call
    Route::post('/twilio/connect-client', [CallController::class, 'connectClient'])->name('twilio.connect-client');
    Route::post('/twilio/recording-status', [TwilioController::class, 'handleRecordingStatus'])->name('twilio.recording-status');

    // Message
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::post('/messages/send', [MessageController::class, 'sendMessage'])->name('messages.send');
    Route::get('/messages/receive', [MessageController::class, 'receiveMessage'])->name('messages.receive');
    Route::get('/sendPusher', [MessageController::class, 'sendpusher'])->name('messages.sendPusher');
    Route::get('/get-messages/{currentUserPhone}', [MessageController::class, 'getMessages'])->name('messages.getMessages');
});

// Route::get('/', [HomeController::class, 'root']);
// Route::get('{any}', [HomeController::class, 'index'])->name('index');


Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

Route::get('/routtee', function () {
    $exitCode = Artisan::call('optimize:clear');
    return 'DONE CLEAR';
});
