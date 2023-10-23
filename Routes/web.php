<?php

use App\Services\Hestia\Http\Controllers\HestiaServiceController;

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

Route::prefix('/service/{order}')->group(function() {

    Route::post('/hestia/change-password', 'HestiaServiceController@changePassword')->name('hestia.change-password');

    Route::prefix('domains')->group(function() {
        Route::get('/view', 'HestiaServiceController@domains')->name('hestia.domains.view');
        Route::post('/create', 'HestiaServiceController@createDomain')->name('hestia.domains.create');
        Route::post('/create-ftp', 'HestiaServiceController@createFTP')->name('hestia.domains.create-ftp');
    });

    Route::prefix('mail')->group(function() {
        Route::get('/view', 'HestiaServiceController@mail')->name('hestia.mail.view');
        Route::post('/create', 'HestiaServiceController@createEmail')->name('hestia.mail.create');
        Route::post('/create-domain', 'HestiaServiceController@createMailDomain')->name('hestia.mail.domain.create');
    });

    Route::prefix('databases')->group(function() {
        Route::get('/view', 'HestiaServiceController@databases')->name('hestia.databases.view');
        Route::post('/create', 'HestiaServiceController@createDatabase')->name('hestia.databases.create');
    });

    Route::prefix('backups')->group(function() {
        Route::get('/view', 'HestiaServiceController@backups')->name('hestia.backups.view');
        Route::get('/create', 'HestiaServiceController@createBackup')->name('hestia.backups.create');
    });
});