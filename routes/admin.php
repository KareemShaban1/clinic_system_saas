<?php

use App\Http\Controllers\Backend\Admin\AreaController;
use App\Http\Controllers\Backend\Admin\CityController;
use App\Http\Controllers\Backend\Admin\ClinicController;
use App\Http\Controllers\Backend\Admin\DashboardController;
use App\Http\Controllers\Backend\Admin\GovernorateController;
use App\Http\Controllers\Backend\Admin\SpecialityController;
use App\Http\Controllers\Backend\AuthController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;







Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/admin',
        'as' => 'admin.',
        'namespace' => 'App\Http\Controllers\Backend\Admin',
        'middleware' => [
            'tenant',
            'auth:admin',
            'verified',
            'localeCookieRedirect',
            'localizationRedirect',
            'localeViewPath'
        ]
    ],
    function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

            Route::get('specialities/data',[SpecialityController::class , 'data'])
            ->name('specialities.data');
            Route::get('specialities',[SpecialityController::class , 'index'])
            ->name('specialities.index');
            Route::post('specialities/store',[SpecialityController::class , 'store'])
            ->name('specialities.store');
            Route::post('specialities/update/{id}',[SpecialityController::class , 'update'])
            ->name('specialities.update');

            Route::get('governorates/data',[GovernorateController::class , 'data'])
            ->name('governorates.data');
            Route::get('governorates',[GovernorateController::class , 'index'])
            ->name('governorates.index');
            Route::post('governorates/store',[GovernorateController::class , 'store'])
            ->name('governorates.store');
            Route::post('governorates/update/{id}',[GovernorateController::class , 'update'])
            ->name('governorates.update');
            Route::delete('governorates/delete/{id}',[GovernorateController::class , 'destroy'])
            ->name('governorates.delete');

            Route::get('cities/data',[CityController::class , 'data'])
            ->name('cities.data');
            Route::get('cities',[CityController::class , 'index'])
            ->name('cities.index');
            Route::post('cities/store',[CityController::class , 'store'])
            ->name('cities.store');
            Route::post('cities/update/{id}',[CityController::class , 'update'])
            ->name('cities.update');
            Route::get('cities/by-governorate', [CityController::class, 'getCitiesByGovernorate'])
            ->name('cities.by-governorate');

            Route::get('areas/data',[AreaController::class , 'data'])
            ->name('areas.data');
            Route::get('areas',[AreaController::class , 'index'])
            ->name('areas.index');
            Route::post('areas/store',[AreaController::class , 'store'])
            ->name('areas.store');
            Route::get('areas/edit/{id}',[AreaController::class , 'edit'])
            ->name('areas.edit');
            Route::post('areas/update/{id}',[AreaController::class , 'update'])
            ->name('areas.update');
            Route::delete('areas/delete/{id}',[AreaController::class , 'destroy'])
            ->name('areas.delete');
            Route::get('areas/by-city', [AreaController::class, 'getAreasByCity'])
            ->name('areas.by-city');
    

            Route::get('clinics/data',action: [ClinicController::class , 'data'])
            ->name('clinics.data');
            Route::get('clinics',[ClinicController::class , 'index'])
            ->name('clinics.index');
            Route::post('clinics/update-status', [ClinicController::class, 'updateStatus'])
            ->name('clinics.update-status');



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
            }
        );


         // Roles Part
         Route::group(
            [
                'prefix' => '/roles',
                'as' => 'roles.',
                'controller' => 'RoleController'
            ],
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('/data',  'data')->name('data');
                Route::get('/add', 'add')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{role_id}', 'edit')->name('edit');
                Route::post('/update/{role_id}', 'update')->name('update');
            }
        );
    }
);
