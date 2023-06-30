<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewPatient;
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\CustomAuthentication;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LogoutResponse;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $request = request();
        // check if route start with admin/
        if ($request->is('admin/*')) {
            
            Config::set('fortify.guard', 'web');
            Config::set('fortify.password', 'users');
            Config::set('fortify.prefix', 'admin');
            
        }

        if ($request->is('patient/*')) {
            Config::set('fortify.guard', 'patient');
            Config::set('fortify.password', 'patients');
            Config::set('fortify.prefix', 'patient');
          
        }


         //// login response
         // redirect user (admin/doctor) or patient after login 
         $this->app->instance(LoginResponse::class,new class implements LoginResponse {
            public function toResponse($request){
             // $request->user('web') // web => guard_name
                 if ($request->user('web')) {
                    // redirect user (admin/doctor) to /backend/dashboard
                     return redirect('/backend/dashboard');
                 }
                 if ($request->user('patient')) {
                    // redirect patient to /patient/dashboard
                     return redirect('/patient/dashboard');
                 }
                 return redirect('/');
            } 
         });


        //// logout response  
        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse {
            public function toResponse($request)
            {
                return redirect('/');
            }
        });
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;
            //// block ip which try more than 5 failed attempts 
            return Limit::perMinute(5)->by($email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

       
         ///// custom code

         if (Config::get('fortify.guard') == 'web') {
            //// this method will be used in "web" guard only
            Fortify::authenticateUsing([new CustomAuthentication,'authenticateUser']);
            //// point to backend auth folder [views/backend/auth]
            Fortify::viewPrefix('backend.auth.');

        } 
        elseif (Config::get('fortify.guard') == 'patient') {

            //// this method will be used in "patient" guard only
            Fortify::authenticateUsing([new CustomAuthentication,'authenticatePatient']);
            
            // create new "patient" using custom class
            Fortify::createUsersUsing(CreateNewPatient::class,'create');

           //// point to frontend auth folder [views/fronted/auth]
            Fortify::viewPrefix('frontend.auth.');
        } 
        
        
    }
}
