<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewAdmin;
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
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
            Config::set('fortify.guard', 'admin');
            Config::set('fortify.password', 'admins');
            Config::set('fortify.prefix', 'admin');
        }

        if ($request->is('clinic/*')) {
            Config::set('fortify.guard', 'web');
            Config::set('fortify.password', 'users');
            Config::set('fortify.prefix', 'clinic');
        }

        if ($request->is('patient/*')) {
            Config::set('fortify.guard', 'patient');
            Config::set('fortify.password', 'patients');
            Config::set('fortify.prefix', 'patient');
        }



        //// login response
        // redirect user (admin/clinic) or patient after login 
        $this->app->instance(LoginResponse::class, new class implements LoginResponse {
            public function toResponse($request)
            {
                // $request->user('web') // web => guard_name
                if ($request->user('web')) {
                    // redirect user (admin/clinic) to /clinic/dashboard
                    return redirect('/clinic/dashboard');
                }
                if ($request->user('patient')) {
                    // dd("patient");

                    // redirect patient to /patient/dashboard
                    return redirect('/patient/dashboard');
                }

                if ($request->user('admin')) {
                    // dd("admin");
                    return redirect()->route('admin.dashboard');
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
            return Limit::perMinute(5)->by($email . $request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });


        ///// custom code

        if (Config::get('fortify.guard') == 'web') {
            //// this method will be used in "web" guard only
            Fortify::authenticateUsing([new CustomAuthentication, 'authenticateUser']);
            //// point to clinic auth folder [views/clinic/auth]
            Fortify::viewPrefix('backend.dashboards.clinic.auth.');
        } elseif (Config::get('fortify.guard') == 'patient') {
            /// this method will be used in "patient" guard only
            Fortify::authenticateUsing([new CustomAuthentication, 'authenticatePatient']);
            // create new "patient" using custom class
            Fortify::createUsersUsing(CreateNewPatient::class, 'create');
            //// point to frontend auth folder [views/fronted/auth]
            Fortify::viewPrefix('backend.dashboards.patient.auth.');
        } elseif (Config::get('fortify.guard') == 'admin') {
            /// this method will be used in "patient" guard only
            Fortify::authenticateUsing([new CustomAuthentication, 'authenticateAdmin']);
            // create new "admin" using custom class
            Fortify::createUsersUsing(CreateNewAdmin::class, 'create');
            //// point to frontend auth folder [views/fronted/auth]
            Fortify::viewPrefix('backend.dashboards.admin.auth.');
        }
    }
}
