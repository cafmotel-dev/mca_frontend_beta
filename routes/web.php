<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'LoginController@index')->name("login");
Route::post('/','LoginController@login')->name("login");
Route::get('/logout', 'LoginController@logout')->name("logout");

Route::group(['middleware' => 'session'], function () {

Route::get('/dashboard', 'DashboardController@index');
Route::get('/dashboard/{lead_status}', 'DashboardController@leadByleadStatus');

Route::post('/dashboard', 'DashboardController@index');



//users
Route::get('/users', 'UserController@index');
Route::get('/user/add', 'UserController@showNew');
Route::post('/user/add', 'UserController@add');
Route::get('/user/{id}/edit', 'UserController@show');
Route::post('/user/{id}/edit', 'UserController@update');
Route::get('/user/profile', 'UserController@profile');
Route::delete('/user/{id}','UserController@delete')->name('user.delete');
Route::get('/changeUserStatus/{id}/{status}', 'UserController@changeUserStatus');


//lenders


//users
Route::get('/lenders', 'LenderController@index');
Route::get('/lender/add', 'LenderController@showNew');
Route::post('/lender/add', 'LenderController@add');
Route::get('/lender/{id}/edit', 'LenderController@show');
Route::post('/lender/{id}/edit', 'LenderController@update');
Route::get('/lender/profile', 'LenderController@profile');
Route::delete('/lender/{id}','LenderController@delete')->name('lender.delete');
Route::get('/changeLenderStatus/{id}/{status}', 'LenderController@changeLenderStatus');


//roles
Route::get('/roles', 'RoleController@index');

//group
Route::get('/groups', 'GroupController@index');
Route::post('/groups','GroupController@add');
Route::post('/groups/edit', 'GroupController@update')->name('group.update');
Route::delete('/groups/{id}','GroupController@delete')->name('group.delete');
Route::get('/changeGroupStatus/{id}/{status}', 'GroupController@changeGroupStatus');

//Labels
Route::get('/labels', 'LabelController@index');
Route::post('/labels','LabelController@add');
Route::post('/labels/edit', 'LabelController@update')->name('label.update');
Route::post('/update/displayorder', 'LabelController@updateDisplayOrder');

Route::delete('/labels/{id}','LabelController@delete')->name('label.delete');
Route::get('/changeLabelStatus/{id}/{status}', 'LabelController@changeLabelStatus');
Route::get('/changeViewOnLead/{id}/{status}', 'LabelController@changeViewOnLead');


//lead status
Route::get('/lead-status', 'LeadStatusController@index');
Route::post('/lead-status','LeadStatusController@add');
Route::post('/lead-status/edit', 'LeadStatusController@update')->name('leadstatus.update');
Route::post('/update-lead-status/displayorder', 'LeadStatusController@updateDisplayOrder');

Route::delete('/lead-status/{id}','LeadStatusController@delete')->name('leadstatus.delete');
Route::get('/changeLeadStatus/{id}/{status}', 'LeadStatusController@changeLeadStatus');
Route::get('/changeViewOnLeadStatus/{id}/{status}', 'LeadStatusController@changeViewOnLeadStatus');


//leads
Route::get('/leads/', 'LeadsController@index');
Route::post('/leads/', 'LeadsController@index');

Route::get('/leads/leadRecords', 'LeadsController@leadRecords');

Route::get('/leads/add', 'LeadsController@addShow');
Route::post('/leads/add', 'LeadsController@add');
Route::post('/leads/import', 'LeadsController@import');

Route::get('/leads/{id}/edit', 'LeadsController@editShow');
Route::post('/update/lead-status', 'LeadsController@updateByLeadStatus');

Route::post('/leads/{id}/edit', 'LeadsController@update');
Route::post('/leads/{id}/delete', 'LeadsController@delete');

Route::get('/lead/view', 'LeadsController@view');


//setting
//smtp

Route::get('/smtps', 'SmtpsController@index');
Route::get('/smtp/{id}/edit', 'SmtpsController@show');
Route::get('/smtp/add', 'SmtpsController@showNew');
Route::post('/smtp/add', 'SmtpsController@add');

Route::post('/check-smtp-setting', 'SmtpsController@checkSMTPSetting');
Route::get('/changeSmtpStatus/{id}/{status}', 'SmtpsController@changeSmtpStatus');
Route::delete('/smtp/{id}','SmtpsController@delete')->name('smtp.delete');
Route::post('/smtp/{id}/edit', 'SmtpsController@update');


//template types
Route::get('/template-types', 'TemplateTypeController@index');
Route::post('/template-types','TemplateTypeController@add');
Route::post('/template-types/edit', 'TemplateTypeController@update')->name('templatetype.update');
Route::delete('/template-types/{id}','TemplateTypeController@delete')->name('templatetype.delete');
Route::get('/changeTemplateTypeStatus/{id}/{status}', 'TemplateTypeController@changeTemplateTypeStatus');



//email templates

Route::get('/email-templates', 'EmailTemplateController@index');
Route::get('/email-template/add', 'EmailTemplateController@showNew');
Route::post('/email-template/add', 'EmailTemplateController@add');
Route::get('/email-template/{id}/edit', 'EmailTemplateController@show');
Route::post('/email-template/{id}/edit', 'EmailTemplateController@update');
Route::get('/changeEmailTemplateStatus/{id}/{status}', 'EmailTemplateController@changeEmailTemplateStatus');
Route::delete('/email-template/{id}','EmailTemplateController@delete')->name('email-template.delete');

//pdf templates

Route::get('/pdf-templates', 'PdfTemplateController@index');
Route::get('/pdf-template/add', 'PdfTemplateController@showNew');
Route::post('/pdf-template/add', 'PdfTemplateController@add');
Route::get('/pdf-template/{id}/edit', 'PdfTemplateController@show');
Route::post('/pdf-template/{id}/edit', 'PdfTemplateController@update');
Route::get('/changePdfTemplateStatus/{id}/{status}', 'PdfTemplateController@changePdfTemplateStatus');
Route::delete('/pdf-template/{id}','PdfTemplateController@delete')->name('pdf-template.delete');


//send email popup

Route::get('/send-email-popup', 'sendEmailPopupController@index');
Route::get('openMailModal', 'MailController@openMailModal');
Route::get('/getTemplate/{id}/{list_id}/{lead_id}', 'MailController@getTemplate');
Route::get('/getLabelValue/{label_id}/{list_id}/{lead_id}', 'MailController@getLabelValue');
Route::get('/getSenderValue/{sender_id}', 'MailController@getSenderValue');
Route::get('send-email/test', 'MailController@sendtestEmail');
Route::get('send-email/generic', 'MailController@sendEmailGeneric');
Route::post('start-dialing/upload', 'MailController@upload')->name('start-dialing.upload');

//notifications
Route::get('notification/add', 'NotificationController@addNotes');
Route::get('lead-source-log/add', 'NotificationController@addLogForLeadSource');


//document uploaded
Route::get('documents', 'DocumentController@list');
Route::get('document/{id}', 'DocumentController@index');
Route::post('document/{id}', 'DocumentController@index');
Route::post('/type-value/post', 'DocumentController@store');

Route::delete('/document/{id}','DocumentController@delete')->name('document.delete');
Route::post('/document', 'DocumentController@update')->name('document.update');


//Document Types
Route::get('/document-types', 'DocumentTypeController@index');
Route::post('/document-types','DocumentTypeController@add');
Route::post('/document-types/edit', 'DocumentTypeController@update')->name('documenttype.update');
Route::delete('/document-types/{id}','DocumentTypeController@delete')->name('documenttype.delete');
Route::get('/changeDocumentTypeStatus/{id}/{status}', 'DocumentTypeController@changeDocumentTypeStatus');



Route::get('/lead/addLead', 'LeadsController@addLead');

Route::get('/404', 'LeadsController@errorPage');
Route::get('generate-pdf/{lead_id}', 'LeadsController@createApplication');
Route::get('preview-pdf/{lead_id}', 'LeadsController@previewApplication');


Route::get('document/signed-application/{lead_id}', 'LeadsController@signedApplication');




//lead source
Route::get('/lead-source', 'LeadSourceController@index');
Route::post('/lead-source','LeadSourceController@add');
Route::post('/lead-sources/edit', 'LeadSourceController@update')->name('leadsource.update');
//Route::delete('/lead-sources/{id}','LeadSourceController@delete')->name('leadstatus.delete');
//Route::get('/changeLeadSource/{id}/{status}', 'LeadSourceController@changeLeadStatus');


//list
Route::get('/lists', 'ListController@index');
Route::get('/list/{id}/edit', 'ListController@show');
Route::post('/list/{id}/edit', 'ListController@show');

Route::get('update-leads/columns/', 'ListController@updateLeadColumns');

Route::post('/lists','ListController@add');
Route::post('/lists/edit', 'ListController@update')->name('list.update');
Route::delete('/lists/{id}','ListController@delete')->name('list.delete');
Route::get('/changeListStatus/{id}/{status}', 'ListController@changeListStatus');


//did

Route::get('/dids', 'DidController@index');


//sms templete
Route::get('sms-templates', 'SmsTempleteController@index');
Route::get('/sms-template/add', 'SmsTempleteController@showNew');
Route::post('/sms-template/add', 'SmsTempleteController@add');
Route::get('/sms-template/{id}/edit', 'SmsTempleteController@show');
Route::post('/sms-template/{id}', 'SmsTempleteController@update');
Route::get('/changeSmsTemplateStatus/{id}/{status}', 'SmsTempleteController@changeSmsemplateStatus');
Route::delete('/sms-template/{id}','SmsTempleteController@delete')->name('sms-template.delete');


//clients
    Route::get('clients', 'ClientController@index');
    Route::get('/client/{id}', 'ClientController@show');
    Route::post('client/manual-subscription', 'ClientController@performManualSubscription');
    Route::post('client/credit-wallet', 'ClientController@creditWallet');
    Route::post('/client/{id}', 'ClientController@update');
    Route::get('client', 'ClientController@showNew');
    Route::post('client', 'ClientController@addNew');


});


Route::get('/merchant/customer/app/index/{client_id}/{lead_id}/{unique_url}', 'MerchantController@index');
Route::post('/merchant/customer/app/index/{client_id}/{lead_id}/{unique_url}', 'MerchantController@index');

Route::post('/types/post', 'MerchantController@store');


