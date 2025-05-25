<?php

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\ClinicController;
use App\Http\Controllers\Backend\SubscribeController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// Route::post('/backup', 'App\Http\Controllers\Backend\BackupController@create')->name('backup.create');


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/clinic',
        'as' => 'clinic.',
        'namespace' => 'App\Http\Controllers\Backend\Clinic',
        'middleware' => [
            'auth:web',
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

        // Reservations Part
        Route::group(
            [
                'prefix' => '/reservations',
                'as' => 'reservations.',
                'controller' => 'ReservationsControllers\ReservationController',
            ],
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('data', 'data')->name('data');
                Route::get('/report', 'todayReservationReport')->name('today_reservation_report');
                Route::get('/today_reservations', 'todayReservations')->name('today_reservations');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/status/{id}/{status}', 'reservationStatus')->name('reservation_status');
                Route::get('/payment/{id}/{payment}', 'paymentStatus')->name('payment_status');
                Route::get('/add/{id}/', 'add')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('destroy');
                Route::get('/trash', 'trash')->name('trash');
                Route::get('/trash-data', 'trashData')->name('trash-data');
                Route::put('/restore/{id}', 'restore')->name('restore');
                Route::delete('/force_delete/{id}', 'forceDelete')->name('forceDelete');
                Route::get('/get_res_slot_number_add', 'getResNumberOrSlotAdd');
                Route::get('/get_res_slot_number_edit', 'getResNumberOrSlotEdit');
            }
        );

        Route::group(
            [
                'prefix' => '/reservations_options',
                'as' => 'reservations_options.',
                'controller' => 'ReservationsControllers\ReservationOptionsController',
            ],
            function () {
                Route::post('/status/{id}', 'reservationStatus')->name('reservation_status');
                Route::get('/payment/{id}/{payment}', 'paymentStatus')->name('payment_status');
                Route::get('/acceptance/{id}/{status}', 'ReservationAcceptance')->name('reservation_acceptance');
            }
        );

        // Online Reservations Part
        Route::group(
            [
                'prefix' => '/online_reservations',
                'as' => 'online_reservations.',
                'controller' => 'ReservationsControllers\OnlineReservationController',
            ],
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('/data', 'data')->name('data');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/status/{id}/{status}', 'reservation_status')->name('reservation_status');
                Route::get('/payment/{id}/{payment}', 'payment_status')->name('payment_status');
                Route::get('/add/{id}/', 'add')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/update/{id}', 'update')->name('update');
                Route::delete('/delete', 'destroy')->name('destroy');
                Route::get('/trash', 'trash')->name('trash');
                Route::put('/restore/{id}', 'restore')->name('restore');
                Route::delete('/force_delete/{id}', 'forceDelete')->name('forceDelete');
            }
        );

        // Number Of Reservations Part
        Route::group(
            [
                'prefix' => '/num_of_reservations',
                'as' => 'num_of_reservations.',
                'controller' => 'ReservationsControllers\NumberOfReservationsController',
            ],
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('/data', 'data')->name('data');
                Route::get('/add', 'add')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{num_of_res}', 'edit')->name('edit');
                Route::post('/update/{num_of_res}', 'update')->name('update');
                Route::delete('/delete/{num_of_res}', 'destroy')->name('destroy');
                Route::get('/trash', 'trash')->name('trash');
                Route::put('/restore/{num_of_res}', 'restore')->name('restore');
                Route::delete('/force_delete/{num_of_res}', 'forceDelete')->name('forceDelete');
            }
        );

        //  Reservations Slots Part
        Route::group(
            [
                'prefix' => '/reservation_slots',
                'as' => 'reservation_slots.',
                'controller' => 'ReservationsControllers\ReservationSlotsController',
            ],
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('/data', 'data')->name('data');
                Route::get('/add', 'add')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{num_of_res}', 'edit')->name('edit');
                Route::post('/update/{num_of_res}', 'update')->name('update');
                Route::delete('/delete/{num_of_res}', 'destroy')->name('destroy');
                Route::get('/trash', 'trash')->name('trash');
                Route::put('/restore/{num_of_res}', 'restore')->name('restore');
                Route::delete('/force_delete/{num_of_res}', 'forceDelete')->name('forceDelete');
            }
        );

        // Drugs / Prescription Part
        Route::group(
            [
                'prefix' => '/prescription',
                'as' => 'prescription.',
                'controller' => 'ReservationsControllers\PrescriptionController',
            ],
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('/add/{id}', 'add')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::post('/upload_prescription', 'UploadPrescription')->name('UploadPrescription');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/arabic_prescription_pdf/{id}', 'arabic_prescription_pdf')->name('arabic_prescription_pdf');
                Route::get('/english_prescription_pdf/{id}', 'english_prescription_pdf')->name('english_prescription_pdf');
            }
        );

        // Medicines Part
        Route::group(
            [
                'prefix' => '/medicines',
                'as' => 'medicines.',
                'controller' => 'ReservationsControllers\MedicineController',
            ],
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('/data', 'data')->name('data');
                Route::get('/add', 'add')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{medicine_id}', 'edit')->name('edit');
                Route::post('/update/{medicine_id}', 'update')->name('update');
                Route::get('/show/{medicine_id}', 'show')->name('show');
                Route::delete('/delete/{medicine_id}', 'destroy')->name('destroy');
                Route::get('/trash', 'trash')->name('trash');
                Route::put('/restore/{medicine_id}', 'restore')->name('restore');
                Route::delete('/force_delete/{medicine_id}', 'forceDelete')->name('forceDelete');
            }
        );

        // Chronic Diseases Part
        Route::group(
            [
                'prefix' => '/chronic_diseases',
                'as' => 'chronic_diseases.',
                'controller' => 'ReservationsControllers\ChronicDiseasesController',
            ],
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('/add/{id}', 'add')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{disease_id}', 'edit')->name('edit');
                Route::post('/update/{disease_id}', 'update')->name('update');
                Route::get('/show/{id}', 'show')->name('show');
            }
        );


        // Glasses Distance Part
        Route::group(
            [
                'prefix' => '/glasses_distance',
                'as' => 'glasses_distance.',
                'controller' => 'ReservationsControllers\GlassesDistanceController',
            ],
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('/add/{id}', 'add')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{disease_id}', 'edit')->name('edit');
                Route::post('/update/{disease_id}', 'update')->name('update');
                Route::get('/glasses_pdf/{glasses_distance_id}', 'glasses_distance_pdf')->name('glasses_distance_pdf');
                // Route::get('/show/{id}','show')->name('show');

            }
        );

        // Rays Part
        Route::group(
            [
                'prefix' => '/rays',
                'as' => 'rays.',
                'controller' => 'ReservationsControllers\RaysController',
            ],
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('/data', 'data')->name('data');
                Route::get('/add/{id}', 'add')->name('add');
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

        // Analysis Part
        Route::group(
            [
                'prefix' => '/analysis',
                'as' => 'analysis.',
                'controller' => 'ReservationsControllers\MedicalAnalysisController',
            ],
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('/data', 'data')->name('data');
                Route::get('/add/{id}', 'add')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{medical_analysis_id}', 'edit')->name('edit');
                Route::post('/update/{medical_analysis_id}', 'update')->name('update');
                Route::get('/show/{id}', 'show')->name('show');
                Route::delete('/delete/{medical_analysis_id}', 'destroy')->name('destroy');
                Route::get('/trash', 'trash')->name('trash');
                Route::put('/restore/{medical_analysis_id}', 'restore')->name('restore');
                Route::delete('/force_delete/{medical_analysis_id}', 'forceDelete')->name('forceDelete');
            }
        );

        // Fees Part
        Route::group(
            [
                'prefix' => '/fees',
                'as' => 'fees.',
                'controller' => 'ReservationsControllers\FeeController'
            ],
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('/today', 'today')->name('today');
                Route::get('/month', 'month')->name('month');
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


        // Events Part
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


        // Settings Part
        Route::group(
            [
                'prefix' => '/settings',
                'as' => 'settings.'
            ],
            function () {
                // settings
                Route::get('/', 'SettingsController@index')->name('index');

                Route::get('/clinic_settings', 'SettingsController@clinicSettings')
                    ->name('clinicSettings.index');
                Route::post('/clinic_settings', 'SettingsController@updateClinicSettings')->name('clinicSettings.update');

                Route::get('/zoom_settings', 'SettingsController@zoomSettings')->name('zoomSettings.index');
                Route::post('/zoom_settings', 'SettingsController@updateZoomSettings')->name('zoomSettings.update');


                Route::get('/reservation_settings', 'SettingsController@reservationSettings')->name('reservationSettings.index');
                Route::post('/reservation_settings', 'SettingsController@updateReservationSettings')->name('reservationSettings.update');
            }
        );


        // Reservation Control Part
        Route::group(
            [
                'prefix' => '/system_control',
                'as' => 'system_control.',
                'controller' => 'ReservationsControllers\SystemControlController'
            ],
            function () {
                Route::get('/', 'index')->name('index');
                Route::post('/update', 'update')->name('update');
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

Route::get('/register-clinic', function () {
    return view('backend.dashboards.clinic.auth.register-clinic');
})->name('register-clinic');
Route::post('/register-clinic', [AuthController::class, 'registerClinic'])->name('register-clinic');
// Route::post('/store-clinic', [ClinicController::class, 'store'])->name('store-clinic');
Route::post('/subscribe', [SubscribeController::class, 'store']);