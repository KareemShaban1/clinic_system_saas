<?php

use App\Http\Controllers\Backend\Patient\DashboardController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Frontend\AppointmentsController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'as' => 'patient.',
    'middleware' => [
        'localeSessionRedirect', 'localizationRedirect', 'localeViewPath',
        'auth:patient'
    ]
], function () {

    // Reservations Part
    Route::group(
        [
            'prefix' => '/appointment',
            'as' => 'appointment.',
            'controller' => 'App\Http\Controllers\Backend\Patient\ReservationController',
        ],
        function () {
            Route::get('/', 'index')->name('index');
            Route::get('/data', 'data')->name('data');
            Route::get('/get_res_slot_number', 'getResNumberOrSlot')->name('get_res_slot_number');
            Route::get('/show_ray/{id}', 'show_ray')->name('show_ray');
            Route::get('/show_chronic_disease/{id}', 'show_chronic_disease')->name('show_chronic_disease');
            Route::get('/show_glasses_distance/{id}', 'show_glasses_distance')->name('show_glasses_distance');
            Route::get('/arabic_prescription_pdf/{id}', 'arabic_prescription_pdf')->name('arabic_prescription_pdf');
            Route::get('/english_prescription_pdf/{id}', 'english_prescription_pdf')->name('english_prescription_pdf');
            Route::get('/add', 'add')->name('add');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::get('/rays_index', 'rays_index')->name('patient_rays');
            Route::get('/patient_chronic_disease', 'patient_chronic_disease')->name('patient_chronic_disease');



        }
    );




    Route::get('/patient/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // Route::get('/get_reservation_slots', [AppointmentsController::class, 'getResNumberOrSlot']);
});


Route::get('/register-patient', function () {
    return view('backend.dashboards.patient.auth.register');
})->name('register-patient');
Route::post('/register-patient', [AuthController::class, 'registerPatient'])->name('register-patient');
