<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view("home");
})->name("home");

Auth::routes();

Route::get('/accountManagement', 'AccountManagementController@index')->name('account_management');
Route::get('/terms', function () {
    return view('terms');
})->name("terms");

Route::middleware(["subscribed"])->group(function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::post('/dashboard/startup', 'DashboardController@startup')->name('dashboard_startup');

    Route::post('/dashboard/clinic/register/save', 'DashboardController@registerClinic')->name('dashboard_register_clinic_save');
    Route::get('/dashboard/clinic/modify', 'DashboardModifyClinicController@index')->name('dashboard_modify_clinic');
    Route::post('/dashboard/clinic/modify/save', 'DashboardModifyClinicController@modifyClinic')->name('dashboard_modify_clinic_save');

    Route::get('/dashboard/clinicalRecordGenerator', 'DashboardClinicalRecordGeneratorController@index')
        ->name('dashboard_clinical_record_generator');
    Route::post('/dashboard/clinicalRecordGenerator/save', 'DashboardClinicalRecordGeneratorController@createClinicalRecord')
        ->name('dashboard_clinical_record_generator_save');

    Route::get('/dashboard/home', 'DashboardHomeController@index')->name('dashboard_home');
    Route::get('/dashboard/home/filterConsultations/{startDate}/{endDate}', 'DashboardHomeController@getFilteredConsultations')
        ->name('dashboard_get_filtered_consultations');
    
    Route::get('/dashboard/patients', 'DashboardPatientsController@index')->name('dashboard_patients');
    Route::get('/dashboard/patients/search/{query}', 'DashboardPatientsController@searchPatients')
        ->name('dashboard_search_patients');
    Route::get('/dashboard/patients/register', 'DashboardRegisterPatientController@index')->name('dashboard_register_patient');
    Route::post('/dashboard/patients/register', 'DashboardRegisterPatientController@registerPatient')
        ->name('dashboard_register_patient_save');
    
    Route::get('/dashboard/patient/{patient_id}', 'DashboardPatientController@index')->name('dashboard_consult_patient');
    Route::get('/dashboard/patient/{patient_id}/modify', 'DashboardModifyPatientController@index')->name('dashboard_modify_patient');
    Route::post('/dashboard/patient/{patient_id}/modify', 'DashboardModifyPatientController@modifyPatient')->name('dashboard_modify_patient_save');
    
    Route::get('/dashboard/patient/{patient_id}/consultations', 'DashboardConsultationsController@index')->name('dashboard_consultations');
    Route::get('/dashboard/patient/{patient_id}/consultations/register', 'DashboardRegisterConsultationController@index')
        ->name('dashboard_register_consultation');
    Route::post('/dashboard/patient/{patient_id}/consultations/register', 'DashboardRegisterConsultationController@registerConsultation')
        ->name('dashboard_register_consultation_save');
    
    Route::get('/dashboard/patient/{patient_id}/consultation/{consultation_id}/details', 'DashboardConsultationController@index')->name('dashboard_consultation');
    Route::get('/dashboard/patient/{patient_id}/consultation/{consultation_id}/finish', 'DashboardFinishConsultationController@index')
        ->name('dashboard_consultation_finish');
    Route::post('/dashboard/patient/{patient_id}/consultation/{consultation_id}/finish', 'DashboardFinishConsultationController@finishConsultation')
        ->name('dashboard_consultation_finish_save');
    Route::post('/dashboard/patient/{patient_id}/consultation/reschedule', 'DashboardConsultationController@rescheduleConsultation')
        ->name('dashboard_reschedule_consultation_save');
    Route::post('/dashboard/patient/{patient_id}/consultation/cancel', 'DashboardConsultationController@cancelConsultation')
        ->name('dashboard_cancel_consultation_save');
        
    Route::get('/dashboard/patient/{patient_id}/clinicalRecord/{clinical_record_id}/{mode}', 'DashboardClinicalRecordController@index')
        ->name('dashboard_clinical_record');
    Route::post('/dashboard/patient/{patient_id}/clinicalRecord/{clinical_record_id}/register', 'DashboardClinicalRecordController@registerClinicalRecord')
        ->name('dashboard_clinical_record_register_save');
    Route::post('/dashboard/patient/{patient_id}/clinicalRecord/{clinical_record_id}/modify', 'DashboardClinicalRecordController@modifyClinicalRecord')
        ->name('dashboard_clinical_record_modify_save');
    
    Route::get('/dashboard/patient/{patient_id}/clinicalRecords', 'DashboardClinicalRecordsController@index')->name('dashboard_clinical_records');
    Route::get('/dashboard/patient/{patient_id}/clinicalRecords/register', 'DashboardRegisterClinicalRecordController@index')
        ->name('dashboard_register_clinical_record');
    
    Route::get('/dashboard/patient/{patient_id}/evolutionNotes', 'DashboardEvolutionNotesController@index')->name('dashboard_evolution_notes');
    
    Route::get('/dashboard/patient/{patient_id}/images', 'DashboardImagesController@index')->name('dashboard_images');
    Route::get('/dashboard/patient/{patient_id}/images/add', 'DashboardAddImageController@index')->name('dashboard_add_image');
    Route::post('/dashboard/patient/{patient_id}/images/add', 'DashboardAddImageController@addImage')->name('dashboard_add_image_save');
    
    Route::get('/dashboard/patient/{patient_id}/odontogram/{type?}', 'DashboardOdontogramController@index')->name('dashboard_odontogram');
    Route::post('/dashboard/patient/{patient_id}/odontogram/addDisease', 'DashboardOdontogramController@addDisease')
        ->name('dashboard_odontogram_add_disease');
    
    Route::get('/dashboard/profile', 'DashboardProfileController@index')->name('dashboard_profile');
    Route::post('/dashboard/profile/pictureFile/save', 'DashboardProfileController@modifyPictureFile')
        ->name('dashboard_modify_profile_picture_save');
    
    Route::get('/dashboard/stats', 'DashboardStatsController@index')->name('dashboard_stats');
    
    Route::get('/image/{disk}/{fileName}', 'PrivateImagesManager@getPictureFile')->where(["fileName" => ".*"])
        ->name('private_images_manager_picture_file');
});

// Route::get("/createStorageLink", function() {
//     Artisan::call('storage:link');
// });
