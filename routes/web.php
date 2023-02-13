<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeCookieRedirect', 'localizationRedirect', 'localeViewPath' ]

],function(){

    Route::group(
        ['prefix'=>'/admin',
        'as'=>'admin.',
        'namespace'=>'App\Http\Controllers\Admin',
        'middleware'=>['auth:sanctum',config('jetstream.auth_session'),'verified']
        ], 
        function(){
    
            Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
          
            Route::group([
                'prefix'=>'/patients',
                'as'=>'patients.',
                'controller'=>'PatientController',], 
                function(){
                Route::get('/', 'index')->name('index');
                Route::get('/show/{patient_id}', 'show')->name('show');
                Route::get('/patient_card/{patient_id}', 'patient_card')->name('patient_card');
                Route::get('/patient_pdf/{patient_id}', 'patient_pdf')->name('patient_pdf');
                Route::get('/add', 'add')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{patient_id}','edit')->name('edit');
                Route::post('/update/{patient_id}','update')->name('update');
                Route::delete('/delete/{patient_id}','destroy')->name('destroy');
                Route::get('/trash','trash')->name('trash');
                Route::put('/restore/{patient_id}','restore')->name('restore');
                Route::delete('/force_delete/{patient_id}','forceDelete')->name('forceDelete');
            });
     
    
            Route::group([
                'prefix'=>'/reservations',
                'as'=>'reservations.',
                'controller'=>'ReservationController',],
             function(){
                Route::get('/', 'index')->name('index');
                Route::get('/today', 'today')->name('today');
                Route::get('/show/{reservation_id}', 'show')->name('show');
                Route::get('/status/{reservation_id}/{status}', 'reservation_status')->name('reservation_status');
                Route::get('/payment/{reservation_id}/{payment}', 'payment_status')->name('payment_status');
                Route::get('/add/{patient_id}/', 'add')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{reservation_id}','edit')->name('edit');
                Route::post('/update/{reservation_id}','update')->name('update');
                Route::delete('/delete/{reservation_id}','destroy')->name('destroy');
                Route::get('/trash','trash')->name('trash');
                Route::put('/restore/{reservation_id}','restore')->name('restore');
                Route::delete('/force_delete/{reservation_id}','forceDelete')->name('forceDelete');
    
            });

            Route::group([
                'prefix'=>'/num_of_reservations',
                'as'=>'num_of_reservations.',
                'controller'=>'NumberOfReservationsController',],
             function(){
                Route::get('/', 'index')->name('index');
                Route::get('/add', 'add')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{num_of_res}','edit')->name('edit');
                Route::post('/update/{num_of_res}','update')->name('update');

               
            });
    
            Route::group([
                'prefix'=>'/drugs',
                'as'=>'drugs.',
                'controller'=>'DrugController',],
             function(){
                Route::get('/', 'index')->name('index');
                Route::get('/add/{reservation_id}', 'add')->name('add');
                Route::get('/prescription/{reservation_id}', 'drug_pdf')->name('drug_pdf');
                Route::post('/store', 'store')->name('store');
                Route::get('/show/{reservation_id}','show')->name('show');
               
            });

            Route::group([
                'prefix'=>'/medicines',
                'as'=>'medicines.',
                'controller'=>'MedicineController',],
             function(){
                Route::get('/', 'index')->name('index');
                Route::get('/add', 'add')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{medicine_id}','edit')->name('edit');
                Route::post('/update/{medicine_id}','update')->name('update');
                Route::get('/show/{medicine_id}','show')->name('show');
                Route::delete('/delete/{medicine_id}','destroy')->name('destroy');
                Route::get('/trash','trash')->name('trash');
                Route::put('/restore/{medicine_id}','restore')->name('restore');
                Route::delete('/force_delete/{medicine_id}','forceDelete')->name('forceDelete');
    
               
            });
    
            Route::group([
                'prefix'=>'/chronic_diseases',
                'as'=>'chronic_diseases.',
                'controller'=>'ChronicDiseasesController',],
             function(){
                Route::get('/', 'index')->name('index');
                Route::get('/add/{reservation_id}', 'add')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::get('/show/{reservation_id}','show')->name('show');
               
            });
    
            Route::group([
                'prefix'=>'/rays',
                'as'=>'rays.',
                'controller'=>'RaysController',],
             function(){
                Route::get('/', 'index')->name('index');
                Route::get('/add/{reservation_id}', 'add')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::get('/show/{reservation_id}','show')->name('show');
               
            });
    
            Route::group([
                'prefix'=>'/fees',
                'as'=>'fees.',
                'controller'=>'FeeController'
            ],
            function(){
                Route::get('/', 'index')->name('index');
                Route::get('/today', 'today')->name('today');
                Route::get('/month', 'month')->name('month');
            });
    
    
    
            Route::group([
                'prefix'=>'/users',
                'as'=>'users.',
                'controller'=>'UserController'
            ],
            function(){
                Route::get('/', 'index')->name('index');
                Route::get('/add', 'add')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{user_id}','edit')->name('edit');
                Route::post('/update/{user_id}','update')->name('update');
            });
    
            Route::group([
                'prefix'=>'/events',
                'as'=>'events.',
                'controller'=>'EventController'
            ],
            function(){
                Route::get('/', 'index')->name('index');
                Route::get('/add', 'add')->name('add');
                Route::delete('/delete/{event_id}','destroy')->name('destroy');
                Route::get('/trash','trash')->name('trash');
                Route::put('/restore/{event_id}','restore')->name('restore');
                Route::delete('/force_delete/{event_id}','forceDelete')->name('forceDelete');
    
            });


            Route::group([
                'prefix'=>'/settings',
                'as'=>'settings.',
                'controller'=>'SettingsController'
            ],
            function(){
                // Route::get('/', 'index')->name('index');
                Route::get('/', 'index')->name('index');
                Route::post('/update', 'update')->name('update');
                // Route::get('/edit/{user_id}','edit')->name('edit');
                // Route::post('/update/{user_id}','update')->name('update');
            });
    
    
    
    
    
        }
    );
    
    
});





Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
