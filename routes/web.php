<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {
    Route::get('/', function () {
        return view('supervisor.auth.login');
    })->name('index');
    Route::get('/offer-details/{id?}', 'Supervisor\OfferController@get_offer_details')
        ->name('get.offer.details');

    Route::PATCH('/offer-details/{id?}', 'Supervisor\OfferController@post_offer_details')
        ->name('post.offer.details');
    Route::POST('/decline-offer', 'Supervisor\OfferController@decline_offer')
        ->name('decline.offer');

    Route::POST('/approve-offer', 'Supervisor\OfferController@approve_offer')
        ->name('approve.offer');

});

// *********  Supervisor Routes ******** //
Route::group(
    [
        'namespace' => 'Supervisor',
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {
    Auth::routes(
        [
            'verify' => false,
            'register' => false,
        ]
    );
    Route::GET('supervisor/login', 'Auth\LoginController@showLoginForm')->name('supervisor.login');
    Route::POST('supervisor/login', 'Auth\LoginController@login');
    Route::POST('supervisor/logout', 'Auth\LoginController@logout')->name('supervisor.logout');
    Route::GET('supervisor/password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('supervisor.password.confirm');
    Route::POST('supervisor/password/confirm', 'Auth\ConfirmPasswordController@confirm');
    Route::get('supervisor/forget-password', 'Auth\ForgotPasswordController@showForgetPasswordForm')->name('supervisor.forget.password.get');
    Route::post('supervisor/forget-password', 'Auth\ForgotPasswordController@submitForgetPasswordForm')->name('supervisor.forget.password.post');
    Route::get('supervisor/reset-password/{phone}', 'Auth\ForgotPasswordController@showResetPasswordForm')->name('supervisor.reset.password.get');
    Route::post('supervisor/reset-password', 'Auth\ForgotPasswordController@submitResetPasswordForm')->name('supervisor.reset.password.post');
});

Route::group(
    [
        'namespace' => 'Supervisor',
        'prefix' => LaravelLocalization::setLocale() . '/supervisor',
        'middleware' => ['auth:supervisor-web', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {
    Route::get('/', 'Auth\LoginController@showLoginForm');
    Route::get('/home', 'HomeController@index')->name('supervisor.home');
    Route::get('/lock-screen', 'HomeController@lock_screen')->name('supervisor.lock.screen');
    // SupervisorProfile Routes
    Route::get('profile/edit/{id}', 'SupervisorController@edit_profile')->name('supervisor.profile.edit');
    Route::patch('profile/update/{id}', 'SupervisorController@update_profile')->name('supervisor.profile.update');

    Route::get('send-sms', 'HomeController@send_sms')->name('send.sms');
    Route::get('send-otp', 'HomeController@send_otp')->name('send.otp');
    Route::get('credentials', 'HomeController@credentials')->name('credentials');
    // Supervisors Routes
    Route::resource('supervisors', 'SupervisorController')->names([
        'index' => 'supervisor.supervisors.index',
        'create' => 'supervisor.supervisors.create',
        'update' => 'supervisor.supervisors.update',
        'destroy' => 'supervisor.supervisors.destroy',
        'edit' => 'supervisor.supervisors.edit',
        'store' => 'supervisor.supervisors.store',
        'show' => 'supervisor.supervisors.show',
    ]);
    Route::post('/remove-selected-supervisors', 'SupervisorController@remove_selected')->name('remove.selected.supervisors');
    Route::get('/print-selected-supervisors', 'SupervisorController@print_selected')->name('print.selected.supervisors');
    Route::post('/export-supervisors-excel', 'SupervisorController@export_supervisors_excel')->name('export.supervisors.excel');
    Route::post('/supervisor-show-projects', 'SupervisorController@show_projects')->name('supervisor.show.projects');
    Route::post('/supervisor-show-job-titles', 'SupervisorController@show_job_titles')->name('supervisor.show.job_titles');

    // Roles Routes
    Route::resource('roles', 'RoleController')->names([
        'index' => 'supervisor.roles.index',
        'create' => 'supervisor.roles.create',
        'update' => 'supervisor.roles.update',
        'destroy' => 'supervisor.roles.destroy',
        'edit' => 'supervisor.roles.edit',
        'store' => 'supervisor.roles.store',
    ]);

    // employees Routes
    Route::resource('employees', 'EmployeeController')->names([
        'index' => 'supervisor.employees.index',
        'create' => 'supervisor.employees.create',
        'update' => 'supervisor.employees.update',
        'destroy' => 'supervisor.employees.destroy',
        'edit' => 'supervisor.employees.edit',
        'store' => 'supervisor.employees.store',
        'show' => 'supervisor.employees.show',
    ]);
    Route::post('/remove-selected-employees', 'EmployeeController@remove_selected')->name('remove.selected.employees');
    Route::get('/print-selected-employees', 'EmployeeController@print_selected')->name('print.selected.employees');
    Route::post('/export-employees-excel', 'EmployeeController@export_employees_excel')->name('export.employees.excel');

    // depts Routes
    Route::resource('depts', 'DeptController')->names([
        'index' => 'supervisor.depts.index',
        'create' => 'supervisor.depts.create',
        'update' => 'supervisor.depts.update',
        'destroy' => 'supervisor.depts.destroy',
        'edit' => 'supervisor.depts.edit',
        'store' => 'supervisor.depts.store',
        'show' => 'supervisor.depts.show',
    ]);
    Route::post('/remove-selected-depts', 'DeptController@remove_selected')->name('remove.selected.depts');
    Route::get('/print-selected-depts', 'DeptController@print_selected')->name('print.selected.depts');
    Route::post('/export-depts-excel', 'DeptController@export_depts_excel')->name('export.depts.excel');

    // job_titles Routes
    Route::resource('job_titles', 'JobTitleController')->names([
        'index' => 'supervisor.job_titles.index',
        'create' => 'supervisor.job_titles.create',
        'update' => 'supervisor.job_titles.update',
        'destroy' => 'supervisor.job_titles.destroy',
        'edit' => 'supervisor.job_titles.edit',
        'store' => 'supervisor.job_titles.store',
        'show' => 'supervisor.job_titles.show',
    ]);
    Route::post('/remove-selected-job-titles', 'JobTitleController@remove_selected')->name('remove.selected.job_titles');
    Route::get('/print-selected-job-titles', 'JobTitleController@print_selected')->name('print.selected.job_titles');
    Route::post('/export-job-titles-excel', 'JobTitleController@export_job_titles_excel')->name('export.job_titles.excel');

    // projects Routes
    Route::resource('projects', 'ProjectController')->names([
        'index' => 'supervisor.projects.index',
        'create' => 'supervisor.projects.create',
        'update' => 'supervisor.projects.update',
        'destroy' => 'supervisor.projects.destroy',
        'edit' => 'supervisor.projects.edit',
        'store' => 'supervisor.projects.store',
        'show' => 'supervisor.projects.show',
    ]);
    Route::post('/remove-selected-projects', 'ProjectController@remove_selected')->name('remove.selected.projects');
    Route::get('/print-selected-projects', 'ProjectController@print_selected')->name('print.selected.projects');
    Route::post('/export-projects-excel', 'ProjectController@export_projects_excel')->name('export.projects.excel');

    // nationalities Routes
    Route::resource('nationalities', 'NationalityController')->names([
        'index' => 'supervisor.nationalities.index',
        'create' => 'supervisor.nationalities.create',
        'update' => 'supervisor.nationalities.update',
        'destroy' => 'supervisor.nationalities.destroy',
        'edit' => 'supervisor.nationalities.edit',
        'store' => 'supervisor.nationalities.store',
        'show' => 'supervisor.nationalities.show',
    ]);

    Route::post('/remove-selected-nationalities', 'NationalityController@remove_selected')->name('remove.selected.nationalities');
    Route::get('/print-selected-nationalities', 'NationalityController@print_selected')->name('print.selected.nationalities');
    Route::post('/export-nationalities-excel', 'NationalityController@export_nationalities_excel')->name('export.nationalities.excel');

    // offers Routes
    Route::resource('offers', 'OfferController')->names([
        'index' => 'supervisor.offers.index',
        'create' => 'supervisor.offers.create',
        'update' => 'supervisor.offers.update',
        'destroy' => 'supervisor.offers.destroy',
        'edit' => 'supervisor.offers.edit',
        'store' => 'supervisor.offers.store',
        'show' => 'supervisor.offers.show',
    ]);

    Route::post('/remove-selected-offers', 'OfferController@remove_selected')->name('remove.selected.offers');
    Route::get('/print-selected-offers', 'OfferController@print_selected')->name('print.selected.offers');
    Route::post('/export-offers-excel', 'OfferController@export_offers_excel')->name('export.offers.excel');
    Route::get('/send-offer-sms/{id?}', 'OfferController@send_offer_sms')->name('send.offer.sms');

    // applications Routes
    Route::resource('applications', 'ApplicationController')->names([
        'index' => 'supervisor.applications.index',
        'create' => 'supervisor.applications.create',
        'update' => 'supervisor.applications.update',
        'destroy' => 'supervisor.applications.destroy',
        'edit' => 'supervisor.applications.edit',
        'store' => 'supervisor.applications.store',
        'show' => 'supervisor.applications.show',
    ]);

    Route::post('/remove-selected-applications', 'ApplicationController@remove_selected')->name('remove.selected.applications');
    Route::get('/print-selected-applications', 'ApplicationController@print_selected')->name('print.selected.applications');
    Route::post('/export-applications-excel', 'ApplicationController@export_applications_excel')->name('export.applications.excel');
    Route::post('/show-offer-details', 'ApplicationController@show_offer_details')->name('show.offer.details');
    Route::post('/show-review-details', 'ApplicationController@show_review_details')->name('show.review.details');
    Route::post('/update-review-details', 'ApplicationController@update_review_details')->name('update.review.details');

    Route::get('/application-approve/{id?}', 'ApplicationController@approve_application')->name('approve.application');
    Route::post('/application-decline', 'ApplicationController@decline_application')->name('decline.application');
    Route::post('/supervisor-get-offer', 'ApplicationController@get_offer')->name('supervisor.get.offer');

    // direct Work Routes

    Route::resource('direct-work', 'DirectWorkController')->names([
        'index' => 'supervisor.direct-work.index',
        'create' => 'supervisor.direct-work.create',
        'update' => 'supervisor.direct-work.update',
        'destroy' => 'supervisor.direct-work.destroy',
        'edit' => 'supervisor.direct-work.edit',
        'store' => 'supervisor.direct-work.store',
        'show' => 'supervisor.direct-work.show',
    ]);
    Route::get('/print-direct-work', 'DirectWorkController@print_selected')->name('print.selected.direct-work');
    Route::post('/export-direct-work', 'DirectWorkController@export_directWork_excel')->name('export.direct-work.excel');
    Route::get('/direct-work-approve/{id?}', 'DirectWorkController@approve_directWork')->name('approve.direct-work');
    Route::get('/direct-work-disapprove/{id?}', 'DirectWorkController@disapprove_directWork')->name('disapprove.direct-work');

    // contracts Routes
    Route::resource('contracts', 'ContractController')->names([
        'index' => 'supervisor.contracts.index',
        'create' => 'supervisor.contracts.create',
        'update' => 'supervisor.contracts.update',
        'destroy' => 'supervisor.contracts.destroy',
        'edit' => 'supervisor.contracts.edit',
        'store' => 'supervisor.contracts.store',
        'show' => 'supervisor.contracts.show',
    ]);

    Route::post('/remove-selected-contracts', 'ContractController@remove_selected')->name('remove.selected.contracts');
    Route::get('/print-selected-contracts', 'ContractController@print_selected')->name('print.selected.contracts');
    Route::post('/export-contracts-excel', 'ContractController@export_contracts_excel')->name('export.contracts.excel');
    Route::post('/show-contract-components', 'ContractController@show_contract_components')->name('show.contract.components');
    Route::post('/show-application-details', 'ContractController@show_application_details')->name('show.application.details');
    Route::get('/send-contract-sms/{id?}', 'ContractController@send_contract_sms')->name('send.contract.sms');

    Route::get('/contract-approved/{id?}', 'ContractController@contract_approved')->name('contract.approved');
    Route::get('/contract-declined/{id?}', 'ContractController@contract_declined')->name('contract.declined');
    Route::get('/contract-expired/{id?}', 'ContractController@contract_expired')->name('contract.expired');
    Route::get('/contract-pending/{id?}', 'ContractController@contract_pending')->name('contract.pending');
    Route::get('/contract-print/{id?}','ContractController@print')->name('contract.print');
    Route::post('/contract-renew','ContractController@renew')->name('contract.renew');

    // employees_transfers Routes
    Route::resource('employees_transfers', 'EmployeeTransferController')->names([
        'index' => 'supervisor.employees_transfers.index',
        'create' => 'supervisor.employees_transfers.create',
        'update' => 'supervisor.employees_transfers.update',
        'destroy' => 'supervisor.employees_transfers.destroy',
        'edit' => 'supervisor.employees_transfers.edit',
        'store' => 'supervisor.employees_transfers.store',
        'show' => 'supervisor.employees_transfers.show',
    ]);
    Route::post('/remove-selected-employees-transfers', 'EmployeeTransferController@remove_selected')->name('remove.selected.employees_transfers');
    Route::get('/print-selected-employees-transfers', 'EmployeeTransferController@print_selected')->name('print.selected.employees_transfers');
    Route::post('/export-employees_transfers-excel', 'EmployeeTransferController@export_employees_transfers_excel')->name('export.employees_transfers.excel');

    Route::get('/contracts-waiting','ReportController@contracts_waiting')->name('contracts.waiting');
    Route::get('/contracts-pending','ReportController@contracts_pending')->name('contracts.pending');
    Route::get('/contracts-approved','ReportController@contracts_approved')->name('contracts.approved');
    Route::get('/contracts-expired','ReportController@contracts_expired')->name('contracts.expired');
    Route::get('/contracts-declined','ReportController@contracts_declined')->name('contracts.declined');

    Route::get('/contracts-custom','ReportController@contracts_custom')->name('contracts.custom');
    Route::post('/contracts-custom-report','ReportController@contracts_custom_report')->name('contracts.custom.report');



});
// *********  User Routes ******** //

// *********  Employee Routes ******** //
Route::group(
    [
        'namespace' => 'Employee',
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {
    Auth::routes(
        [
            'verify' => false,
            'register' => false,
        ]
    );
    Route::GET('employee/login', 'Auth\LoginController@showLoginForm')->name('employee.login');
    Route::POST('employee/login', 'Auth\LoginController@login');
    Route::POST('employee/logout', 'Auth\LoginController@logout')->name('employee.logout');
    Route::GET('employee/password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('employee.password.confirm');
    Route::POST('employee/password/confirm', 'Auth\ConfirmPasswordController@confirm');
    Route::get('employee/forget-password', 'Auth\ForgotPasswordController@showForgetPasswordForm')->name('employee.forget.password.get');
    Route::post('employee/forget-password', 'Auth\ForgotPasswordController@submitForgetPasswordForm')->name('employee.forget.password.post');
    Route::get('employee/reset-password/{phone}', 'Auth\ForgotPasswordController@showResetPasswordForm')->name('employee.reset.password.get');
    Route::post('employee/reset-password', 'Auth\ForgotPasswordController@submitResetPasswordForm')->name('employee.reset.password.post');
});

Route::group(
    [
        'namespace' => 'Employee',
        'prefix' => LaravelLocalization::setLocale() . '/employee',
        'middleware' => ['auth:employee-web', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {
    Route::get('/', 'Auth\LoginController@showLoginForm');
    Route::get('/home', 'HomeController@index')->name('employee.home');
    Route::get('/lock-screen', 'HomeController@lock_screen')->name('employee.lock.screen');
    // EmployeeProfile Routes
    Route::get('profile/edit/{id}', 'EmployeeController@edit_profile')->name('employee.profile.edit');
    Route::patch('profile/update/{id}', 'EmployeeController@update_profile')->name('employee.profile.update');
    // contracts Routes
    Route::resource('contracts', 'ContractController')->names([
        'index' => 'employee.contracts.index',
        'show' => 'employee.contracts.show',
    ]);
    Route::post('/show-application-details', 'ContractController@show_application_details')
        ->name('employee.show.application.details');
    Route::get('/contract-print/{id?}','ContractController@print')->name('employee.contract.print');
    Route::post('/contract-approved/', 'ContractController@contract_approved')->name('employee.contract.approved');
    Route::get('/personal-data/{id?}','HomeController@personal_data')->name('employee.personal.data');


});

?>
