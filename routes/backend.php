<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
          'prefix' => LaravelLocalization::setLocale() . '/backend',
          'as' => 'backend.',
          'namespace' => 'App\Http\Controllers\Backend',
          'middleware' => [
            'auth:web',
            'verified',
            'localeCookieRedirect',
            'localizationRedirect',
            'localeViewPath']
    ],
    function () {

        // Dashboard Part
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');

        // Patients Part
        Route::group(
            [
            'prefix' => '/patients',
            'as' => 'patients.',
            'controller' => 'PatientController',],
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('/show/{patient_id}', 'show')->name('show');
                Route::get('/patient_card/{patient_id}', 'patient_card')->name('patient_card');
                Route::get('/patient_pdf/{patient_id}', 'patientPdf')->name('patient_pdf');
                Route::get('/add', 'add')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{patient_id}', 'edit')->name('edit');
                Route::post('/update/{patient_id}', 'update')->name('update');
                Route::delete('/delete/{patient_id}', 'destroy')->name('destroy');
                Route::get('/trash', 'trash')->name('trash');
                Route::put('/restore/{patient_id}', 'restore')->name('restore');
                Route::delete('/force_delete/{patient_id}', 'forceDelete')->name('forceDelete');
            }
        );

        // Reservations Part
        Route::group(
            [
            'prefix' => '/reservations',
            'as' => 'reservations.',
            'controller' => 'ReservationsControllers\ReservationController',],
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('/report', 'todayReservationReport')->name('today_reservation_report');
                Route::get('/today_reservations', 'todayReservations')->name('today_reservations');
                Route::get('/show/{reservation_id}', 'show')->name('show');
                Route::get('/status/{reservation_id}/{status}', 'reservationStatus')->name('reservation_status');
                Route::get('/payment/{reservation_id}/{payment}', 'paymentStatus')->name('payment_status');
                Route::get('/add/{patient_id}/', 'add')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{reservation_id}', 'edit')->name('edit');
                Route::post('/update/{reservation_id}', 'update')->name('update');
                Route::delete('/delete/{reservation_id}', 'destroy')->name('destroy');
                Route::get('/trash', 'trash')->name('trash');
                Route::put('/restore/{reservation_id}', 'restore')->name('restore');
                Route::delete('/force_delete/{reservation_id}', 'forceDelete')->name('forceDelete');
                Route::get('/get_res_slot_number_add', 'getResNumberOrSlotAdd');
                Route::get('/get_res_slot_number_edit', 'getResNumberOrSlotEdit');


            }
        );

        Route::group(
            [
            'prefix' => '/reservations_options',
            'as' => 'reservations_options.',
            'controller' => 'ReservationsControllers\ReservationOptionsController',],
            function () {
                Route::get('/status/{reservation_id}/{res_status}', 'reservationStatus')->name('reservation_status');
                Route::get('/payment/{reservation_id}/{payment}', 'paymentStatus')->name('payment_status');
                Route::get('/acceptance/{reservation_id}/{status}', 'ReservationAcceptance')->name('reservation_acceptance');


            }
        );

        // Online Reservations Part
        Route::group(
            [
            'prefix' => '/online_reservations',
            'as' => 'online_reservations.',
            'controller' => 'ReservationsControllers\OnlineReservationController',],
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('/show/{reservation_id}', 'show')->name('show');
                Route::get('/status/{reservation_id}/{status}', 'reservation_status')->name('reservation_status');
                Route::get('/payment/{reservation_id}/{payment}', 'payment_status')->name('payment_status');
                Route::get('/add/{patient_id}/', 'add')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{reservation_id}', 'edit')->name('edit');
                Route::post('/update/{reservation_id}', 'update')->name('update');
                Route::delete('/delete', 'destroy')->name('destroy');
                Route::get('/trash', 'trash')->name('trash');
                Route::put('/restore/{reservation_id}', 'restore')->name('restore');
                Route::delete('/force_delete/{reservation_id}', 'forceDelete')->name('forceDelete');

            }
        );

        // Number Of Reservations Part
        Route::group(
            [
            'prefix' => '/num_of_reservations',
            'as' => 'num_of_reservations.',
            'controller' => 'ReservationsControllers\NumberOfReservationsController',],
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('/add', 'add')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{num_of_res}', 'edit')->name('edit');
                Route::post('/update/{num_of_res}', 'update')->name('update');


            }
        );

        //  Reservations Slots Part
        Route::group(
            [
                'prefix' => '/reservation_slots',
                'as' => 'reservation_slots.',
                'controller' => 'ReservationsControllers\ReservationSlotsController',],
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('/add', 'add')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{num_of_res}', 'edit')->name('edit');
                Route::post('/update/{num_of_res}', 'update')->name('update');

            }
        );

        // Drugs / Prescription Part
        Route::group(
            [
            'prefix' => '/prescription',
            'as' => 'prescription.',
            'controller' => 'ReservationsControllers\PrescriptionController',],
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('/add/{reservation_id}', 'add')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::post('/upload_prescription', 'UploadPrescription')->name('UploadPrescription');
                Route::get('/show/{reservation_id}', 'show')->name('show');
                Route::get('/arabic_prescription_pdf/{reservation_id}', 'arabic_prescription_pdf')->name('arabic_prescription_pdf');
                Route::get('/english_prescription_pdf/{reservation_id}', 'english_prescription_pdf')->name('english_prescription_pdf');


            }
        );

        // Medicines Part
        Route::group(
            [
            'prefix' => '/medicines',
            'as' => 'medicines.',
            'controller' => 'ReservationsControllers\MedicineController',],
            function () {
                Route::get('/', 'index')->name('index');
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
            'controller' => 'ReservationsControllers\ChronicDiseasesController',],
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('/add/{reservation_id}', 'add')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{disease_id}', 'edit')->name('edit');
                Route::post('/update/{disease_id}', 'update')->name('update');
                Route::get('/show/{reservation_id}', 'show')->name('show');

            }
        );


        // Glasses Distance Part
        Route::group(
            [
            'prefix' => '/glasses_distance',
            'as' => 'glasses_distance.',
            'controller' => 'ReservationsControllers\GlassesDistanceController',],
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('/add/{reservation_id}', 'add')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{disease_id}', 'edit')->name('edit');
                Route::post('/update/{disease_id}', 'update')->name('update');
                Route::get('/glasses_pdf/{glasses_distance_id}', 'glasses_distance_pdf')->name('glasses_distance_pdf');
                // Route::get('/show/{reservation_id}','show')->name('show');

            }
        );

        // Rays Part
        Route::group(
            [
            'prefix' => '/rays',
            'as' => 'rays.',
            'controller' => 'ReservationsControllers\RaysController',],
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('/add/{reservation_id}', 'add')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{ray_id}', 'edit')->name('edit');
                Route::post('/update/{ray_id}', 'update')->name('update');
                Route::get('/show/{reservation_id}', 'show')->name('show');

            }
        );

        // Fees Part
        Route::group(
            [
            'prefix' => '/fees',
            'as' => 'fees.',
            'controller' => 'ReservationsControllers\FeeController'],
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
            'controller' => 'UserController'],
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('/add', 'add')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{user_id}', 'edit')->name('edit');
                Route::post('/update/{user_id}', 'update')->name('update');
            }
        );


        // Events Part
        Route::group(
            [
            'prefix' => '/events',
            'as' => 'events.',
            'controller' => 'EventController'],
            function () {
                Route::get('/', 'index')->name('index');
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

                Route::get('/clinic_settings', 'SettingsController@clinicSettings')->name('clinicSettings.index');
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
            'controller' => 'ReservationsControllers\SystemControlController'],
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
            'controller' => 'RolesPermissionsController'],
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('/add', 'add')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{role_id}', 'edit')->name('edit');
                Route::post('/update/{role_id}', 'update')->name('update');
            }
        );



    }
);