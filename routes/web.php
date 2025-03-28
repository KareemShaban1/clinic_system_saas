<?php

use App\Http\Controllers\Backend\Admin\AreaController;
use App\Http\Controllers\Backend\Admin\CityController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;

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

Route::get('/', function () {
    return view('laravel_files.welcome');
});

Route::get('cities/by-governorate', [CityController::class, 'getCitiesByGovernorate'])
->name('cities.by-governorate');

Route::get('areas/by-city', [AreaController::class, 'getAreasByCity'])
->name('areas.by-city');

require __DIR__.'/backend.php';

require __DIR__.'/frontend.php';

require __DIR__.'/admin.php';