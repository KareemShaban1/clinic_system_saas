<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ReservationControl;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // remove "data" wrapper from json resource response
        JsonResource::withoutWrapping();

        view()->composer('backend.layouts.main-sidebar', function ($view) {
            $collection = ReservationControl::all();
            $setting = $collection->flatMap(function ($collection) {
                return [$collection->key => $collection->value];
            });
    
            $view->with('setting', $setting);
        });
    }
}
