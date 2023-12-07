<?php

use App\Http\Controllers\Api\AccessTokenController;
use App\Http\Controllers\Api\ReservationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return Auth::guard('sanctum')->user();
});

Route::post('auth/access-tokens', [AccessTokenController::class,'store'])
->middleware('guest:sanctum');
// guest : don't auth using sanctum

Route::delete('auth/access-tokens/{token?}', [AccessTokenController::class,'destroy'])
->middleware('auth:sanctum');

Route::group(
    [
        'controller' => 'App\Http\Controllers\Api\PatientController',
    ],
    function () {
        Route::get('/patients', 'index');
        Route::get('/show_patient/{patient}', 'show');
        Route::post('/store_patient', 'store');
        Route::put('/update_patient/{id}', 'update');
        Route::delete('/delete_patient/{id}', 'delete');
        Route::put('/restore_patient/{id}', 'restore');
        Route::delete('/force_delete_patient/{id}', 'forceDelete');
    }
);
// Route::apiResource('reservations',ReservationController::class);

Route::group(
    [
        'controller' => 'App\Http\Controllers\Api\ReservationController',
    ],
    function () {
        Route::get('/reservations', 'index');
        Route::get('/today_reservations', 'todayReservations');
        Route::get('/show_reservation/{reservation}', 'show');
        Route::post('/store_reservation', 'store');
        Route::put('/update_reservation/{reservation}', 'update');
        Route::delete('/delete_reservation/{id}', 'delete');
        Route::put('/restore_reservation/{id}', 'restore');
        Route::delete('/force_delete_reservation/{id}', 'forceDelete');
        Route::get('/reservationNumSlots', 'getResNumberOrSlotAdd');
        
    }
);

Route::group(
    [
        'controller' => 'App\Http\Controllers\Api\ChronicDiseasesController',
    ],
    function () {
        Route::get('/chronic_disease', 'index');
        Route::get('/show_chronic_disease/{chronic_disease}', 'show');
        Route::post('/store_chronic_disease', 'store');
        Route::put('/update_chronic_disease/{chronic_disease}', 'update');
        Route::delete('/delete_chronic_disease/{id}', 'delete');
    }
);
Route::group(
    ['controller' => 'App\Http\Controllers\Api\RaysController',],
    function () {
        Route::get('/rays', 'index');
        Route::get('/show_ray/{ray_id}', 'show');
        Route::post('/store_ray', 'store');
        Route::put('/update_ray/{ray_id}', 'update');
        Route::delete('/delete_ray/{ray_id}', 'delete');
    }
);

Route::group(
    ['controller' => 'App\Http\Controllers\Api\MedicalAnalysisController',],
    function () {
        Route::get('/medical_analysis', 'index');
        // Route::get('/show_ray/{ray_id}', 'show');
        // Route::post('/store_ray', 'store');
        // Route::put('/update_ray/{ray_id}', 'update');
        // Route::delete('/delete_ray/{ray_id}', 'delete');
    }
);


Route::group(
    ['controller' => 'App\Http\Controllers\Api\NumberOfReservationsController',],
    function () {
        Route::get('/numberOfReservations', 'index');
        Route::get('/show_numberOfReservation/{number_id}', 'show');
        Route::post('/store_numberOfReservation', 'store');
        Route::put('/update_numberOfReservation/{number_id}', 'update');
        Route::delete('/delete_numberOfReservation/{number_id}', 'delete');
    }
);

Route::group(
    ['controller' => 'App\Http\Controllers\Api\MedicineController',],
    function () {
        Route::get('/medicines', 'index');
        Route::get('/show_medicine/{medicine_id}', 'show');
        Route::post('/store_medicine', 'store');
        Route::put('/update_medicine/{medicine_id}', 'update');
        Route::delete('/delete_medicine/{medicine_id}', 'delete');
    }
);


// patients , show_patient , store_patient , update_patient , delete_patient
// reservations , show_reservation , store_reservation , update_reservation , delete_reservation
// medicines , show_medicine , store_medicine , update_medicine , delete_medicine