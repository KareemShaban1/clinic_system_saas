<?php

namespace App\Providers;

use App\Models\BaseModel;
use App\Models\Patient;
use App\Models\Scopes\ClinicScope;
use App\Models\Settings;
use App\Models\SystemControl;
use App\Observers\BaseModelObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Auth;
use MacsiDigital\Zoom\Setting;

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

        // view()->composer('backend.dashboards.clinic.layouts.main-sidebar', function ($view) {
        //     $collection = Settings::where('type', 'system_control')->get();
        //     $setting = $collection->flatMap(function ($collection) {
        //         return [$collection->key => $collection->value];
        //     });

        //     $view->with('setting', $setting);
        // });


        // $collection = Settings::all();
        // $settings = $collection->pluck('value', 'key')->toArray();

        // // Merge the retrieved data with the existing configuration
        // config()->set('custom_config', $settings);

        BaseModel::observe(BaseModelObserver::class);

        if (Auth::check()) {
            Patient::addGlobalScope(new ClinicScope);
        }
    }
}
