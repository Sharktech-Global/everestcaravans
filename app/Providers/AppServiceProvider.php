<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\VehicleType;
use Illuminate\Support\Facades\View;

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
        config([
            'auth.providers.admins.model' => \App\Admin::class,
        ]);
        View::composer('*', function ($view) {
            $vehicleTypes = VehicleType::where('status', 1)
                ->orderBy('name')
                ->get(['name', 'slug']);

            $view->with('footerVehicleTypes', $vehicleTypes);
        });
    }
}
