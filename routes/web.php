<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LeadController;
use App\Http\Controllers\LeadBoardController;
use App\Http\Controllers\LeadStatusSettingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TwilioController;
use App\Http\Controllers\EmailTemplateController;
use App\Http\Controllers\CallController;

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

Route::get('/', [HomeController::class, 'root']);
// Route::get('{any}', [HomeController::class, 'index'])->name('index');

Route::get('/lead', [LeadController::class, 'index'])->name('leads.index');
Route::get('/lead/{id}/edit', [LeadController::class, 'edit'])->name('leads.edit');
Route::post('/lead/update/{id}', [LeadController::class, 'update'])->name('leads.update');
Route::delete('/lead/{id}', [LeadController::class, 'destroy'])->name('leads.destroy');


// archived
Route::get('/archived', [LeadController::class, 'archived'])->name('leads.archived');
Route::get('/restore/{id}', [LeadController::class, 'restore'])->name('leads.restore');
Route::delete('/delete/{id}', [LeadController::class, 'delete'])->name('leads.delete');


// leadboard

Route::get('/leadboards',[LeadBoardController::class,'index'])->name('leadboard');
Route::post('leadboards/updateIndex', [LeadBoardController::class, 'updateIndex'])->name('leadboards.update_index');


// leadstatus

Route::get('/lead-status-settings', [LeadStatusSettingController::class, 'create'])->name('lead-status.create');
Route::post('/lead-status-settings', [LeadStatusSettingController::class, 'store'])->name('lead-status.store');
Route::get('/lead-status-settings/{id}/edit', [LeadStatusSettingController::class, 'edit'])->name('leadstatus.edit');
Route::put('/lead-status-settings/{id}', [LeadStatusSettingController::class, 'update'])->name('lead-status.update');
Route::delete('/lead-status-settings/{id}', [LeadStatusSettingController::class, 'destroy'])->name('lead-status.destroy');

//email template
Route::get('/email-templates', [EmailTemplateController::class, 'index'])->name('email.index');
Route::get('/email-templates/create', [EmailTemplateController::class, 'create'])->name('email.create');
Route::post('/email-templates', [EmailTemplateController::class, 'store'])->name('email.store');
Route::delete('/email-templates/{id}', [EmailTemplateController::class, 'destroy'])->name('email.destroy');
Route::post('/email-templates/deleteAll', [EmailTemplateController::class, 'deleteAll'])->name('email.deleteAll');
Route::get('/email-templates/{id}/edit', [EmailTemplateController::class, 'edit'])->name('email.edit');
Route::put('/email-templates/{id}', [EmailTemplateController::class, 'update'])->name('email.update');

Route::post('/lead/permanentdeleteAll', [LeadController::class, 'permanentdeleteAll'])->name('leads.permanentdeleteAll');



// Route::post('/make-call', 'TwilioController@makeCall')->name('make-call');

// Route::post('/make-call', [TwilioController::class, 'makeCall'])->name('make-call');
// Route::match(['get', 'post'], '/connect-to-agent', [TwilioController::class, 'connectToAgent'])->name('connectToAgent');
// Route::match(['get', 'post'], '/handle-call', [TwilioController::class, 'handleCall'])->name('handleCall');
// Route::post('/status-callback', [TwilioController::class, 'statusCallback'])->name('statusCallback');

Route::post('/make-call', [TwilioController::class, 'makeCall'])->name('make-call');
Route::post('/hold-call', [TwilioController::class, 'holdCall'])->name('hold-call');
Route::match(['get', 'post'], '/connect-to-agent', [TwilioController::class, 'connectToAgent'])->name('connectToAgent');
Route::match(['get', 'post'], '/handle-call', [TwilioController::class, 'handleCall'])->name('handleCall');
Route::post('/status-callback', [TwilioController::class, 'statusCallback'])->name('statusCallback');
Route::post('status-callback', [TwilioController::class, 'callStatusCallback'])->name('callStatusCallback');
Route::get('/get-call-duration', [TwilioController::class, 'getCallDuration'])->name('get-call-duration');


Route::post('/end-call', [TwilioController::class, 'endCall'])->name('end-call');




Route::post('/outbound-call', [CallController::class, 'outboundCall'])->name('outbound-call');
Route::post('/twilio/user-gather', [CallController::class, 'userGather'])->name('twilio.user-gather');



Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

Route::get('/routtee', function () {
   $exitCode = Artisan::call('optimize:clear');
   return 'DONE CLEAR';
});

