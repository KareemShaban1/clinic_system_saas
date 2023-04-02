<?php

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

Route::get('/patients',['App\Http\Controllers\Api\PatientController','index']);
Route::get('/show/{id}',['App\Http\Controllers\Api\PatientController','show']);
Route::post('/create',['App\Http\Controllers\Api\PatientController','create']);
Route::patch('/update/{id}',['App\Http\Controllers\Api\PatientController','update']);
Route::delete('/delete/{id}',['App\Http\Controllers\Api\PatientController','delete']); 
Route::put('/restore/{id}',['App\Http\Controllers\Api\PatientController','restore']); 
Route::delete('/force_delete/{id}',['App\Http\Controllers\Api\PatientController','forceDelete']); 
