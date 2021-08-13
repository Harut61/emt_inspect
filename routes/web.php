<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes([
    'register' => false
]);

Route::middleware(['auth'])->group(function () {
    Route::get('/', 'MainController@index')->name('index');
    Route::get('/vulnerability-timeline', 'VulnerabilityTimelineController@index')->name('vulnerability-timeline');
    Route::get('/vulnerability-list', 'VulnerabilityListController@index')->name('vulnerability-list');
    // Detailed vulnerabilities routes
    Route::get('/detailed-vulnerabilities/last-5-weeks/{type}', 'DetailedVulnerabilityListController@showLastFiveWeeksByType')
        ->name('detailedVulnerabilitiesForFiveWeeks');
    Route::get('/detailed-vulnerabilities/{date}/{type}', 'DetailedVulnerabilityListController@showByDateAndType')->name('detailedVulnerabilities');
    Route::get('/download-results-list/{result_ids}/{type}/{start_of_day}', 'DetailedVulnerabilityListController@downloadResultsCSV');
    // Errors log routes
    Route::get('/error-logging', 'ErrorsLoggingController@index')->name('error-logging');
    Route::get('/download-error-logs', 'ErrorsLoggingController@downloadLogsCSV')->name('error-loggs-csv');

    // Server health
    Route::get('/vulnerability-health', 'VulnerabilityHealthController@index')->name('vulnerability-health');
    Route::get('/vulnerability-health/pagination/{service}', 'VulnerabilityHealthController@paginateAjax');
    Route::get('/vulnerability-health/csv-logs/{service}', 'VulnerabilityHealthController@downloadLogsCSV');

    Route::get('/edit-user', 'UserController@edit')->name('edit-user');
    Route::post('/update-user', 'UserController@update')->name('update-user');
});

Route::get('/forgot-password', 'MainController@forgotPassword')->name('forgot-password');

Route::get('/password/reset', function() {
    return redirect(route('forgot-password'));
});

Route::get('/certificate', 'CertificateController@index')->name('certificate');
Route::post('/certificate', 'CertificateController@upload')->name('certificate.upload');
