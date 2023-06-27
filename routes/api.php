<?php

use App\Http\Controllers\Api\ReservationController;
use Illuminate\Http\Request;
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
    return $request->user();
});

Route::group(
    [
        'controller'=>'App\Http\Controllers\Api\PatientController',
    ], 
    function () {
    Route::get('/patients', 'index');
    Route::get('/show_patient/{patient}', 'show');
    Route::post('/store_patient', 'store');
    Route::put('/update_patient/{id}', 'update');
    Route::delete('/delete_patient/{id}',  'delete');
    Route::put('/restore_patient/{id}', 'restore');
    Route::delete('/force_delete_patient/{id}', 'forceDelete');
});
// Route::apiResource('reservations',ReservationController::class);

Route::group(
    [
        'controller'=>'App\Http\Controllers\Api\ReservationController',
    ], 
    function () {
    Route::get('/reservations', 'index');
    Route::get('/show_reservation/{reservation}', 'show');
    Route::post('/store_reservation', 'store');
    Route::put('/update_reservation/{reservation}', 'update');
    Route::delete('/delete_reservation/{id}',  'delete');
    Route::put('/restore_reservation/{id}', 'restore');
    Route::delete('/force_delete_reservation/{id}', 'forceDelete');
});
