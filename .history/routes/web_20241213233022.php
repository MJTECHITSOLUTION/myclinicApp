<?php

use App\Http\Controllers\analyseController;
use App\Http\Controllers\PrescriptionController;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use App\Events\NotifyMessage;
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

Route::get('/', function () {
    return view('auth.login');
});


Auth::routes(['register' => false]);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/lang/{locale}', 'HomeController@lang');
Route::post('/update-switch-state', 'HomeController@updateSwitchState');
Route::get('/get-switch-state', 'HomeController@getSwitchState');

Route::get('/send-notify', function (\Illuminate\Http\Request $request) {
    try {
        event(new NotifyMessage($request->all()));
        return back()->with('success', 'Notification envoyée avec succès');
    } catch (\Exception $e) {
        return back()->with('error', 'Erreur lors de l\'envoi de la notification');
    }
})->name('send.notify');

Route::get('/getChequeDetails', [\App\Http\Controllers\BillingController::class, 'getChequeDetails']);

//Patients
Route::get('/patient/create', 'PatientController@create')->name('patient.create')->middleware(['role_or_permission:Admin|add patient']);
Route::post('/patient/create', 'PatientController@store')->name('patient.store');
Route::post('/update_selected_patient', 'PatientController@updateSelectedPatient')->name('update_selected_patient');
Route::get('/patient/all', 'PatientController@all')->name('patient.all')->middleware(['role_or_permission:Admin|view all patients']);
Route::get('/patient/view/{id}', 'PatientController@view')->where('id', '[0-9]+')->name('patient.view')->middleware(['role_or_permission:Admin|view patient']);
Route::get('/patient/edit/{id}', 'PatientController@edit')->where('id', '[0-9]+')->name('patient.edit')->middleware(['role_or_permission:Admin|edit patient']);
Route::post('/patient/edit', 'PatientController@store_edit')->name('patient.store_edit');
Route::get('/patient/delete/{id}', 'PatientController@destroy')->where('id', '[0-9]+')->name('patient.destroy')->middleware(['role_or_permission:Admin|delete patient']);
Route::any('/patient/search', 'PatientController@search')->name('patient.search');
Route::get('/consultation/list/{id}', 'PatientController@showListconsultation')->name('consultation.list');
Route::get('/paiement/list/{id}', 'PatientController@showListpaiement')->name('paiement.list');
Route::get('/seance/list/{id}','PatientController@showListseance')->name('seance.list');
//Documents
Route::get('/document/all', 'DocumentController@all')->name('document.all')->middleware(['role_or_permission:Admin|edit patient']);
Route::post('/document/create', 'DocumentController@store')->name('document.store')->middleware(['role_or_permission:Admin|edit patient']);
Route::get('/document/delete/{id}','DocumentController@destroy')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|edit patient']);
Route::get('/document/view/{id}', 'DocumentController@view')->name('document.view');


//history
Route::post('/history/create', 'HistoryController@store')->name('history.store')->middleware(['role_or_permission:Admin|edit patient']);
Route::get('/history/delete/{id}','HistoryController@destroy')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|edit patient']);


//Appointments
Route::get('/appointment/create', 'AppointmentController@create')->name('appointment.create')->middleware(['role_or_permission:Admin|create appointment']);
Route::get('/appointment/create/{id}', 'AppointmentController@btncreate')->name('appointment.btncreate')->middleware(['role_or_permission:Admin|create appointment']);
Route::post('/appointment/create', 'AppointmentController@store')->name('appointment.store');
Route::get('/appointment/all', 'AppointmentController@all')->name('appointment.all')->middleware(['role_or_permission:Admin|view all appointments']);
Route::get('/appointment/calendar', 'AppointmentController@calendar')->name('appointment.calendar')->middleware(['role_or_permission:Admin|view all appointments']);
Route::get('/appointment/pending', 'AppointmentController@pending')->name('appointment.pending')->middleware(['role_or_permission:Admin|view all appointments']);
Route::get('/appointment/checkslots/{id}','AppointmentController@checkslots');
Route::get('/appointment/delete/{id}','AppointmentController@destroy')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|delete appointment']);
Route::post('/appointment/edit', 'AppointmentController@store_edit')->name('appointment.store_edit')->middleware(['role_or_permission:Admin|edit appointment']);
Route::get('/appointment/day', 'AppointmentController@day')->name('appointment.day')->middleware(['role_or_permission:Admin|view all appointments']);
Route::match(['get', 'post'], '/appointment/dayfilter', 'AppointmentController@dayfilter')->name('dayfilter.search');


//Drugs
Route::get('/drug/create', 'DrugController@create')->name('drug.create')->middleware(['role_or_permission:Admin|create drug']);
Route::post('/drug/create', 'DrugController@store')->name('drug.store');
Route::get('/drug/edit/{id}', 'DrugController@edit')->where('id', '[0-9]+')->name('drug.edit')->middleware(['role_or_permission:Admin|edit drug']);
Route::post('/drug/edit', 'DrugController@store_edit')->name('drug.store_edit');
Route::get('/drug/all', 'DrugController@all')->name('drug.all')->middleware(['role_or_permission:Admin|view all drugs']);
Route::get('/drug/delete/{id}','DrugController@destroy')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|delete drug']);
Route::match(['get', 'post'], '/drug/search', 'DrugController@search')->name('drug.search');

Route::post('/categories/add', 'DrugController@add_cat')->name('categories.add');
Route::post('/categories/edit', 'DrugController@edit_cat')->name('categories.edit');
Route::post('/categories/delete', 'DrugController@delete_cat')->name('categories.delete');



//assurance
Route::get('/assurance/create', 'AssuranceController@create')->name('assurance.create');
Route::post('/assurance/create', 'AssuranceController@store')->name('assurance.store');
Route::get('/assurance/edit/{id}', 'AssuranceController@edit')->where('id', '[0-9]+')->name('assurance.edit');
Route::post('/assurance/edit', 'AssuranceController@store_edit')->name('assurance.store_edit');
Route::get('/assurance/all', 'AssuranceController@all')->name('assurance.all');
Route::get('/assurance/delete/{id}','AssuranceController@destroy')->where('id', '[0-9]+');

//Anticedents
Route::get('/anticedents/create', 'AnticedentsController@create')->name('anticedents.create');
Route::get('/anticedents/view', 'AnticedentsController@view')->name('antecident.view');
Route::post('/anticedents/create', 'AnticedentsController@store')->name('anticedents.store');
Route::get('/anticedents/edit/{id}', 'AnticedentsController@edit')->where('id', '[0-9]+')->name('anticedents.edit');
Route::post('/anticedents/edit', 'AnticedentsController@store_edit')->name('anticedents.store_edit');
Route::get('/anticedents/all', 'AnticedentsController@all')->name('anticedents.all');
Route::get('/anticedents/delete/{id}','AnticedentsController@destroy')->where('id', '[0-9]+');


//Tests
Route::get('/test/create', 'TestController@create')->name('test.create')->middleware(['role_or_permission:Admin|create diagnostic test']);
Route::post('/test/create', 'TestController@store')->name('test.store');
Route::get('/test/edit/{id}', 'TestController@edit')->name('test.edit')->middleware(['role_or_permission:Admin|edit diagnostic test']);
Route::post('/test/edit', 'TestController@store_edit')->name('test.store_edit');
Route::get('/test/all', 'TestController@all')->name('test.all')->middleware(['role_or_permission:Admin|view all diagnostic tests']);
Route::get('/test/delete/{id}', 'TestController@destroy')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|delete diagnostic test']);


//analyse
Route::get('/analyse/create', 'AnalyseController@create')->name('analyse.create');
Route::post('/analyse/create', 'AnalyseController@store')->name('analyse.store');
Route::get('/analyse/edit/{id}', 'AnalyseController@edit')->name('analyse.edit');
Route::post('/analyse/edit', 'AnalyseController@store_edit')->name('analyse.store_edit');
Route::get('/analyse/all', 'AnalyseController@all')->name('analyse.all');
Route::get('/analyse/delete/{id}', 'AnalyseController@destroy')->where('id', '[0-9]+');
Route::match(['get', 'post'], '/analyse/search', 'AnalyseController@search')->name('analyse.search');


//radio
Route::get('/radio/create', 'Prescription_radioController@create')->name('radio.create');
Route::post('/radio/create', 'Prescription_radioController@store')->name('radio.store');
Route::get('/radio/edit/{id}', 'Prescription_radioController@edit')->name('radio.edit');
Route::post('/radio/edit', 'Prescription_radioController@store_edit')->name('radio.store_edit');
Route::get('/radio/all', 'Prescription_radioController@all')->name('radio.all');
Route::get('/radio/delete/{id}', 'Prescription_radioController@destroy')->where('id', '[0-9]+');
Route::Any('/radio/search', 'Prescription_radioController@search')->name('radio.search');


//Prescriptions
Route::get('/prescription/create', 'PrescriptionController@create')->name('prescription.create')->middleware(['role_or_permission:Admin|create prescription']);
Route::get('/prescription/data', 'PrescriptionController@data')->name('prescription.data')->middleware(['role_or_permission:Admin|create prescription']);
Route::post('/prescription/create', 'PrescriptionController@store')->name('prescription.store');
Route::get('/prescription/all', 'PrescriptionController@all')->name('prescription.all')->middleware(['role_or_permission:Admin|view all prescriptions']);
Route::get('/prescription/view/{id}', 'PrescriptionController@view')->where('id', '[0-9]+')->name('prescription.view')->middleware(['role_or_permission:Admin|view prescription']);
Route::get('/prescription/pdf/{id}','PrescriptionController@pdf')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|print prescription']);
Route::get('/prescription/delete/{id}','PrescriptionController@destroy')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|delete prescription']);
Route::get('/prescription/user/{id}', 'PrescriptionController@view_for_user')->where('id', '[0-9]+')->name('prescription.view_for_user')->middleware(['role_or_permission:Admin|view patient']);
Route::get('/prescription/edit/{id}','PrescriptionController@edit')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|edit prescription']);
Route::post('/prescription/update', 'PrescriptionController@update')->name('prescription.update');
Route::get('/get-patient-data/{patient_id}', 'PrescriptionController@getPatientData');
Route::get('/remove-acte/{id}', 'PrescriptionController@remove')->name('remove-acte');
Route::get('/remove-rapport/{id}', 'PrescriptionController@remove_rapport')->name('remove-rapport');
Route::get('/getBillingInfo', 'PrescriptionController@getBillingInfo')->name('getBillingInfo');
Route::get('/prescription/search', 'PrescriptionController@search')->name('prescription.search');
Route::get('/get-medicaments-by-type', 'PrescriptionController@getDrugsByType')->name('get.medicaments.by.type');
Route::get('/get-posologie-by-medicament', 'PrescriptionController@getPosologieByMedicament')->name('get.posologie.by.medicament');
Route::post('/prescription_medicament/delete/{id}', 'PrescriptionController@destroy_medicament')->name('prescription_medicament.destroy');
//Route::get('/get-drugs-by-type', 'PrescriptionController@getDrugsByType')->name('get.drugs.by.type');

Route::post('/billing/update-date/{id}', 'BillingController@updateDate')->name('billing.update.date');





// dropdown
Route::get('/getAnalyses/{testId}', 'PrescriptionController@getAnalyses')->name('getAnalyses');

// Route to store the analyse_id
Route::post('/storeAnalyseId', 'PrescriptionController@storeAnalyseId')->name('storeAnalyseId');

// Route to remove the stored analyse_id
Route::post('/removeAnalyseId', 'PrescriptionController@removeAnalyseId')->name('removeAnalyseId');
//Graph
Route::get('get-labels', 'GraphController@getLabels')->name('get-labels');
Route::any('/graph/search', 'GraphController@search')->name('graph.search');
Route::get('/getGraphData/13', 'GraphController@getGraphData')->name('getGraphData');
Route::get('/graph/create', 'GraphController@create')->name('graph.create');
Route::post('/graph/create', 'GraphController@store')->name('graph.store');
Route::get('/graph/all', 'GraphController@all')->name('graph.all')->middleware(['role_or_permission:Admin|view all graph']);
Route::get('/graph/view/{id}', 'GraphController@view')->where('id', '[0-9]+')->name('graph.view')->middleware(['role_or_permission:Admin|view graph']);
Route::get('/graph/pdf/{id}','GraphController@pdf')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|print prescription']);
Route::get('/graph/delete/{id}','GraphController@destroy')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|delete prescription']);
Route::get('/graph/user/{id}', 'GraphController@view_for_user')->where('id', '[0-9]+')->name('graph.view_for_user')->middleware(['role_or_permission:Admin|view patient']);
Route::get('/graph/edit/{id}','GraphController@edit')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|edit prescription']);
Route::post('/delete-point', 'GraphController@deletePoint')->name('point.delete');
Route::post('/point-save', 'GraphController@savePoint')->name('point-save');
Route::post('/graph/update', 'GraphController@update')->name('graph.update');
Route::post('/get-graph-data', 'GraphController@getGraphData')->name('get-graph-data');
Route::get('/get-patient-image', 'GraphController@getPatientImage')->name('graph.getPatientImage');

//Rapport
Route::get('/rapport/create', 'RapportController@create')->name('rapport.create');
Route::post('/rapport/create', 'RapportController@store')->name('rapport.store');
Route::get('/rapport/all', 'RapportController@all')->name('rapport.all')->middleware(['role_or_permission:Admin|view all rapport']);
Route::get('/rapport/view/{id}', 'RapportController@view')->where('id', '[0-9]+')->name('rapport.view')->middleware(['role_or_permission:Admin|view rapport']);
Route::get('/rapport/pdf/{id}','RapportController@pdf')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|print prescription']);
Route::get('/rapport/delete/{id}','RapportController@destroy')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|delete prescription']);
Route::get('/rapport/user/{id}', 'RapportController@view_for_user')->where('id', '[0-9]+')->name('rapport.view_for_user')->middleware(['role_or_permission:Admin|view patient']);
Route::get('/rapport/edit/{id}','RapportController@edit')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|edit prescription']);
Route::post('/rapport/update', 'RapportController@update')->name('rapport.update');

//Gabarit
Route::post('/gabarit/gabarit_update', 'RapportController@gabarit_update')->name('gabarit.gabarit_update');
Route::get('/gabarit/gabarit', 'RapportController@create_gabarit')->name('gabarit.gabarit');
Route::post('/gabarit/gabarit', 'RapportController@store_gabarit')->name('gabarit.store_gabarit');
Route::get('/gabarit/gabarit_view/{name}', 'RapportController@gabarit_view')->name('gabarit.gabarit_view');
Route::get('/gabarit/gabarit_all', 'RapportController@gabarit_all')->name('gabarit.gabarit_all')->middleware(['role_or_permission:Admin|view all rapport']);
Route::get('/gabarit/gabarit_edit/{id}','RapportController@gabarit_edit')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|edit prescription']);
Route::post('/gabarit/gabarit_view', 'RapportController@store_template')->name('gabarit.store_patient');
Route::get('/gabarit/all', 'RapportController@all_gabarit_patient')->name('gabarit.all')->middleware(['role_or_permission:Admin|view all rapport']);
Route::get('/gabarit/view/{id}', 'RapportController@view_patient')->name('gabarit.view');
Route::get('/gabarit/edit/{id}','RapportController@patient_edit')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|edit prescription']);
Route::post('/gabarit/update', 'RapportController@patient_update')->name('gabarit.patient_update');
Route::get('/gabarit/delete/{id}','RapportController@patient_destroy')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|delete prescription']);
Route::get('gabarit/gabarit_delete/{id}','RapportController@gabarit_destroy')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|delete prescription']);

//Billing
Route::get('/billing/create', 'BillingController@create')->name('billing.create')->middleware(['role_or_permission:Admin|create invoice']);
Route::post('/billing/create', 'BillingController@store')->name('billing.store');
Route::get('/billing/all', 'BillingController@all')->name('billing.all')->middleware(['role_or_permission:Admin|view all invoices']);
Route::get('/billing/view/{id}', 'BillingController@view')->where('id', '[0-9]+')->name('billing.view')->middleware(['role_or_permission:Admin|view invoice']);
Route::get('/billing/pdf/{id}','BillingController@pdf')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|print invoice']);
Route::get('/billing/delete/{id}','BillingController@destroy')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|delete invoice']);
Route::get('/billing_act/delete/{id}','BillingController@destroy_act')->where('id', '[0-9]+');
Route::get('/billing/edit/{id}','BillingController@edit')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|edit invoice']);
Route::get('/billing/reglement/{id}','BillingController@reglement')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|edit invoice']);
Route::post('/billing/update', 'BillingController@update')->name('billing.update');
Route::post('/billing/updateregle', 'BillingController@updateregle')->name('billing.updateregle');
Route::get('/billing/all/{id}', 'BillingController@showall')->name('billing.showall');
Route::get('/fetch/{actId}', 'BillingController@fetchBillingInfo');
Route::get('/get-reg/{id}', 'BillingController@showreg')->name('get-reg');
Route::get('/delete-reg/{id}', 'BillingController@deleteRow');
Route::get('/billing/search', 'BillingController@search')->name('billing.search');
Route::get('/billing/facture/{id}','BillingController@trueFacture')->where('id', '[0-9]+')->name('billing.facture');
Route::get('/billing/false_facture/{id}','BillingController@falseFacture')->where('id', '[0-9]+')->name('billing.false_facture');
Route::get('/billing/facture', 'BillingController@facture')->name('billing.facture')->middleware(['role_or_permission:Admin|view all invoices']);

Route::post('/billing/update-date/{id}', 'BillingController@updateDate')->name('billing.update.date');


//Settings
/* Doctorino Settings */
Route::get('/settings/doctorino_settings', 'SettingController@doctorino_settings')->name('doctorino_settings.edit');
Route::post('/settings/doctorino_settings', 'SettingController@doctorino_settings_store')->name('doctorino_settings.store');
/* Prescription Settings */
Route::get('/settings/prescription_settings', 'SettingController@prescription_settings')->name('prescription_settings.edit');
Route::post('/settings/prescription_settings', 'SettingController@prescription_settings_store')->name('prescription_settings.store');

/* SMS Settings */
Route::get('/settings/sms_settings', 'SettingController@sms_settings')->name('sms_settings.edit');
Route::post('/settings/sms_settings', 'SettingController@sms_settings_store')->name('sms_settings.store');

/* Users */
Route::get('/users/all', 'UsersController@all')->name('user.all');
Route::get('/users/create', 'UsersController@create')->name('user.create');
Route::post('/users/create', 'UsersController@store')->name('user.store');
Route::get('/users/edit/{id}', 'UsersController@edit')->where('id', '[0-9]+')->name('user.edit');
Route::get('/users/edit', 'UsersController@edit_profile')->name('user.edit_profile');
Route::post('/users/edit', 'UsersController@store_edit')->name('user.store_edit');
Route::get('/users/delete/{id}', 'UsersController@destroy')->where('id', '[0-9]+')->name('user.destroy')->middleware(['role_or_permission:Admin|delete patient']);

/* Roles */
Route::get('/roles/all', 'RolesController@all_roles')->name('roles.all')->middleware(['role_or_permission:Admin']);
Route::get('/role/create', 'RolesController@create')->name('role.create')->middleware(['role_or_permission:Admin']);
Route::post('/role/create', 'RolesController@store')->name('role.store');
Route::get('/role/edit/{id}', 'RolesController@edit_role')->where('id', '[0-9]+')->name('role.edit_role')->middleware(['role_or_permission:Admin']);
Route::post('/role/edit', 'RolesController@store_edit_role')->name('role.store_edit_role');
Route::get('/role/delete/{id}','RolesController@destroy')->where('id', '[0-9]+')->name('role.destroy')->middleware(['role_or_permission:Admin']);
/* Payment */
Route::get('/payment/create', 'PaymentController@create')->name('payment.create');
Route::post('/payment/create', 'PaymentController@store')->name('payment.store');
Route::get('/payment/edit/{id}', 'PaymentController@edit')->name('payment.edit');
Route::post('/payment/edit', 'PaymentController@store_edit')->name('payment.store_edit');
Route::get('/payment/all', 'PaymentController@all')->name('payment.all');
Route::get('/payment/delete/{id}', 'PaymentController@destroy')->where('id', '[0-9]+');
Route::match(['get', 'post'], '/radio/search', 'PaymentController@search')->name('payment.search');
/*Record*/
Route::match(['get', 'post'], '/record/search', 'RecordController@searchByDateRangePatient')->name('record.search');
Route::match(['get', 'post'], '/record/payment', 'RecordController@getPaymentsByDateRange')->name('record.paiement');
Route::match(['get', 'post'], '/record/consultation', 'RecordController@consultation')->name('record.consultation');
Route::match(['get', 'post'], '/record/rdv', 'RecordController@rdv')->name('record.rdv');
Route::match(['get', 'post'], '/record/assurance', 'RecordController@assurance')->name('record.assurance');
Route::match(['get', 'post'], '/record/assuranceconsultation', 'RecordController@consultationParAssurance')->name('record.assuranceconsultation');
Route::get('/record/all', 'RecordController@all')->name('record.all');
Route::get('/record/allC', 'RecordController@allC')->name('record.allC');
Route::get('/record/allR', 'RecordController@allR')->name('record.allR');
Route::get('/record/allA', 'RecordController@allA')->name('record.allA');
Route::get('/record/allCA', 'RecordController@allCA')->name('record.allCA');
Route::get('/record/allP', 'RecordController@payment')->name('record.allP');
Route::any('/clear-session', 'HomeController@clearSession')->name('clear.session');

Route::get('/fournisseur/all', 'FournisseurController@all')->name('fournisseur.all');
Route::get('/fournisseur/create', 'FournisseurController@create')->name('fournisseur.create');
Route::post('/fournisseur/create', 'FournisseurController@store')->name('fournisseur.store');
Route::get('/fournisseur/edit/{id}', 'FournisseurController@edit')->where('id', '[0-9]+')->name('fournisseur.edit');
Route::post('/fournisseur/edit', 'FournisseurController@store_edit')->name('fournisseur.store_edit');
Route::get('/fournisseur/delete/{id}', 'FournisseurController@destroy')->where('id', '[0-9]+')->name('fournisseur.destroy');
Route::get('/fournisseur/view/{id}', 'FournisseurController@view')->where('id', '[0-9]+')->name('fournisseur.view');
Route::any('/fournisseur/search', 'FournisseurController@search')->name('fournisseur.search');

Route::get('/item/all', 'ItemController@all')->name('item.all');
Route::get('/item/create', 'ItemController@create')->name('item.create');
Route::post('/item/create', 'ItemController@store')->name('item.store');
Route::get('/item/edit/{id}', 'ItemController@edit')->where('id', '[0-9]+')->name('item.edit');
Route::post('/item/edit', 'ItemController@store_edit')->name('item.store_edit');
Route::get('/item/delete/{id}', 'ItemController@destroy')->where('id', '[0-9]+')->name('item.destroy');
Route::get('/item/view/{id}', 'ItemController@view')->where('id', '[0-9]+')->name('item.view');
Route::any('/item/search', 'ItemController@search')->name('item.search');
Route::post('/item/create_category', 'ItemController@search')->name('item.create_category');

Route::get('/category/all', 'CategoryController@all')->name('category.all');
Route::get('/category/create', 'CategoryController@create')->name('category.create');
Route::post('/category/create', 'CategoryController@store')->name('category.store');
Route::get('/category/edit/{id}', 'CategoryController@edit')->where('id', '[0-9]+')->name('category.edit');
Route::post('/category/edit', 'CategoryController@store_edit')->name('category.store_edit');
Route::get('/category/delete/{id}', 'CategoryController@destroy')->where('id', '[0-9]+')->name('category.destroy');
Route::get('/category/view/{id}', 'CategoryController@view')->where('id', '[0-9]+')->name('category.view');

Route::get('/purchase/all', 'purchaseController@all')->name('purchase.all');
Route::get('/purchase/create', 'purchaseController@create')->name('purchase.create');
Route::post('/purchase/create', 'purchaseController@store')->name('purchase.store');
Route::get('/purchase/edit/{id}', 'purchaseController@edit')->where('id', '[0-9]+')->name('purchase.edit');
Route::post('/purchase/edit', 'purchaseController@store_edit')->name('purchase.store_edit');

Route::get('/purchase/delete/{id}', 'purchaseController@destroy')->where('id', '[0-9]+')->name('purchase.destroy');
Route::get('/purchase/view/{id}', 'purchaseController@view')->where('id', '[0-9]+')->name('purchase.view');
Route::any('/purchase/purchase_status/{id}', 'purchaseController@purchase_status')->name('purchase.status');

Route::get('/tva/all', 'tvaController@all')->name('tva.all');
Route::get('/tva/create', 'tvaController@create')->name('tva.create');
Route::post('/tva/create', 'tvaController@store')->name('tva.store');
Route::get('/tva/edit/{id}', 'tvaController@edit')->where('id', '[0-9]+')->name('tva.edit');
Route::post('/tva/edit', 'tvaController@store_edit')->name('tva.store_edit');
Route::get('/tva/delete/{id}', 'tvaController@destroy')->where('id', '[0-9]+')->name('tva.destroy');
Route::get('/tva/view/{id}', 'tvaController@view')->where('id', '[0-9]+')->name('tva.view');

Route::get('/depense/all', 'DepenseController@all')->name('depense.all');
Route::get('/depense/create', 'DepenseController@create')->name('depense.create');
Route::post('/depense/create', 'DepenseController@store')->name('depense.store');
Route::get('/depense/edit/{id}', 'DepenseController@edit')->where('id', '[0-9]+')->name('depense.edit');
Route::post('/depense/edit', 'DepenseController@store_edit')->name('depense.store_edit');
Route::get('/depense/delete/{id}', 'DepenseController@destroy')->where('id', '[0-9]+')->name('depense.destroy');
Route::get('/depense/view/{id}', 'DepenseController@view')->where('id', '[0-9]+')->name('depense.view');

Route::get('/type_depose/all', 'TypeDeposeController@all')->name('type_depose.all');
Route::get('/type_depose/create', 'TypeDeposeController@create')->name('type_depose.create');
Route::post('/type_depose/create', 'TypeDeposeController@store')->name('type_depose.store');
Route::get('/type_depose/edit/{id}', 'TypeDeposeController@edit')->where('id', '[0-9]+')->name('type_depose.edit');
Route::post('/type_depose/edit', 'TypeDeposeController@store_edit')->name('type_depose.store_edit');
Route::get('/type_depose/delete/{id}', 'TypeDeposeController@destroy')->where('id', '[0-9]+')->name('type_depose.destroy');
/* Acte*/
Route::get('/act/create_act','ActController@create_act')->name('act.create_act');
Route::get('/act/create_category_act','ActController@create_category_act')->name('act.create_category_act');
Route::get('/act/create_sous_category_act','ActController@create_sous_category_act')->name('act.create_sous_category_act');
Route::post('/act/create_category_act', 'ActController@store_category')->name('familie.acte');
Route::post('/act/create_sous_category_act', 'ActController@store_sous_category_act')->name('category.acte');
Route::post('/act/create_act', 'ActController@store_act')->name('create.acte');
Route::get('/create_sous_category_act/{categoryActId}', 'ActController@getSousCategoryActs');

Route::get('/act/create_act/{id}', 'ActController@destroy')->where('id', '[0-9]+')->name('act.destroy');
Route::get('/act/create_sous_category_act/{id}', 'ActController@destroysouscategory')->where('id', '[0-9]+')->name('act.destroysouscategory');
Route::get('/act/create_category_act/{id}', 'ActController@destroyfamily')->where('id', '[0-9]+')->name('act.destroyfamily');
// edit part
Route::get('/edit-family/{id}','ActController@editfamily');
Route::get('/edit-cat/{id}','ActController@editcat');
Route::get('/edit-acte/{id}','ActController@editacte');
//update part
Route::put('update-actf','ActController@updatef');
Route::put('update-actg','ActController@updateg');
Route::put('/update-acte', 'ActController@update')->name('update.acte');
//search
Route::any('/act/searchcat', 'ActController@searchcat')->name('cat.search');
Route::any('/act/searchact', 'ActController@searchact')->name('act.search');

//Route::get('/act/create_act/{id}', 'ActController@edit')->where('id', '[0-9]+')->name('acte.edit');
//note honoraire
Route::get('/notehonoraire/create', 'NoteHonoraire@create')->name('notehonoraire.create');

Route::post('/notehonoraire/store', 'NoteHonoraire@store')->name('notehonoraire.store');
Route::get('/notehonoraire/all', 'NoteHonoraire@all')->name('notehonoraire.all');
Route::get('notehonoraire/view/{id}', 'NoteHonoraire@view')->name('notehonoraire.view');
Route::delete('notehonoraire/delete/{id}', 'NoteHonoraire@destroy')->name('note.destroy');

Route::get('/generate-pdf/{patientId}/{noteId}', 'NoteHonoraire@generatePDF')->name('generate.pdf');
Route::get('/generate-verso-pdf/{id}', 'NoteHonoraire@versoPdf')->name('generat_everso.pdf');
Route::get('/cnss-pdf/{patientId}/{noteId}', 'NoteHonoraire@rectoCnss')->name('cnss.pdf');
Route::get('/cnss-verso-pdf/{id}', 'NoteHonoraire@cnssversoPdf')->name('cnss_verso.pdf');


Route::get('/appointment/delete/{id}', 'AppointmentController@destroyWaiting')->where('id', '[0-9]+')->name('appointment.destroy');


