<?php

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\ClinicController;
use App\Http\Controllers\Backend\SubscribeController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/medical-laboratory',
        'as' => 'medicalLaboratory.',
        'namespace' => 'App\Http\Controllers\Backend\MedicalLaboratory',
        'middleware' => [
            'auth:medical_laboratory',
            'verified',
            'localeCookieRedirect',
            'localizationRedirect',
            'localeViewPath'
        ]
    ],
    function () {

        Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->name('logs');

        // Dashboard Part
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');

        Route::group(
            [
                'prefix' => '/events',
                'as' => 'events.',
                'controller' => 'EventController'
            ],
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('/data', 'data')->name('data');
                Route::get('/show', 'show')->name('show');
                Route::get('/add', 'add')->name('add');
                Route::delete('/delete/{event_id}', 'destroy')->name('destroy');
                Route::get('/trash', 'trash')->name('trash');
                Route::put('/restore/{event_id}', 'restore')->name('restore');
                Route::delete('/force_delete/{event_id}', 'forceDelete')->name('forceDelete');
            }
        );

          // Analysis Part
          Route::group(
            [
                'prefix' => '/analysis',
                'as' => 'analysis.',
                'controller' => 'MedicalAnalysisController',
            ],
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('/data', 'data')->name('data');
                Route::get('/create', 'create')->name('create');
                Route::get('/add/{patient_id}', 'add')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{medical_analysis_id}', 'edit')->name('edit');
                Route::put('/update/{medical_analysis_id}', 'update')->name('update');
                Route::get('/show/{id}', 'show')->name('show');
                Route::delete('/delete/{medical_analysis_id}', 'destroy')->name('destroy');
                Route::get('/trash', 'trash')->name('trash');
                Route::put('/restore/{medical_analysis_id}', 'restore')->name('restore');
                Route::delete('/force_delete/{medical_analysis_id}', 'forceDelete')->name('forceDelete');
            }
        );



        // Patients Part
        Route::group(
            [
                'prefix' => '/patients',
                'as' => 'patients.',
                'controller' => 'PatientController',
            ],
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('data', 'data')->name('data');
                Route::get('/trash-data', 'trashData')->name('trash-data');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/patient_card/{id}', 'patient_card')->name('patient_card');
                Route::get('/patient_pdf/{id}', 'patientPdf')->name('patient_pdf');
                Route::get('/add', 'add')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('destroy');
                Route::get('/trash', 'trash')->name('trash');
                Route::put('/restore/{id}', 'restore')->name('restore');
                Route::delete('/force_delete/{id}', 'forceDelete')->name('forceDelete');

                Route::get('/add_patient_code', 'add_patient_code')->name('add_patient_code');
                Route::get('/search', 'search');
                Route::post('/assign', 'assignPatient')->name('assignPatient');
                Route::post('/unassign/{patient_id}', 'unassignPatient')->name('unassignPatient');
            }
        );


        // Rays Part
        Route::group(
            [
                'prefix' => '/rays',
                'as' => 'rays.',
                'controller' => 'RaysController',
            ],
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('/data', 'data')->name('data');
                Route::get('/add/{id}', 'add')->name('add');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{ray_id}', 'edit')->name('edit');
                Route::post('/update/{ray_id}', 'update')->name('update');
                Route::get('/show/{id}', 'show')->name('show');
                Route::delete('/delete/{ray_id}', 'destroy')->name('destroy');
                Route::get('/trash', 'trash')->name('trash');
                Route::put('/restore/{ray_id}', 'restore')->name('restore');
                Route::delete('/force_delete/{ray_id}', 'forceDelete')->name('forceDelete');
            }
        );


        // User Part
        Route::group(
            [
                'prefix' => '/users',
                'as' => 'users.',
                'controller' => 'UserController'
            ],
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('/data',  'data')->name('data');
                Route::get('/add', 'add')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{user_id}', 'edit')->name('edit');
                Route::post('/update/{user_id}', 'update')->name('update');
                Route::delete('/delete/{user_id}', 'destroy')->name('destroy');
            }
        );



        // Roles Part
        Route::group(
            [
                'prefix' => '/roles',
                'as' => 'roles.',
                'controller' => 'RolesPermissionsController'
            ],
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('/permissions', 'permissions')->name('permissions');
                Route::get('/data',  'data')->name('data');
                Route::get('/add', 'add')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{role_id}', 'edit')->name('edit');
                Route::post('/update/{role_id}', 'update')->name('update');
            }
        );

        // Service Fee Part
        Route::group(
            [
                'prefix' => '/service_fee',
                'as' => 'serviceFees.',
                'controller' => 'ServiceFeeController'
            ],
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('/data', 'data')->name('data');
                Route::get('/add', 'add')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{service_fee_id}', 'edit')->name('edit');
                Route::post('/update/{service_fee_id}', 'update')->name('update');
                Route::delete('/delete/{service_fee_id}', 'destroy')->name('destroy');
            }
        );

        Route::group(
            [
                'prefix' => '/type',
                'as' => 'type.',
                'controller' => 'TypeController'
            ],
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('/data', 'data')->name('data');
                Route::get('/add', 'add')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{type_id}', 'edit')->name('edit');
                Route::post('/update/{type_id}', 'update')->name('update');
                Route::delete('/delete/{type_id}', 'destroy')->name('destroy');
            }
        );
    }

);

Route::get('/register-medical-laboratory', function () {
    return view('backend.dashboards.medicalLaboratory.auth.register-medical-laboratory');
})->name('register-medical-laboratory');
Route::post('/register-medical-laboratory', [AuthController::class, 'registerMedicalLaboratory'])
->name('register-medical-laboratory');
Route::post('/subscribe', [SubscribeController::class, 'store']);
