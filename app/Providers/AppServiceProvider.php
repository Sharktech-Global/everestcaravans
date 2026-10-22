<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\VehicleType;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Event;
use Illuminate\Mail\Events\MessageSending;

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
    // public function boot()
    // {
    //     config([
    //         'auth.providers.admins.model' => \App\Admin::class,
    //     ]);
    //     View::composer('*', function ($view) {
    //         $vehicleTypes = VehicleType::where('status', 1)
    //             ->orderBy('name')
    //             ->get(['name', 'slug']);

    //         $view->with('footerVehicleTypes', $vehicleTypes);
    //     });
    // }

    public function boot()
    {
        config([
            'auth.providers.admins.model' => \App\Admin::class,
        ]);

        View::composer('*', function ($view) {

             $vehicleTypes = VehicleType::where('status', 1)
            ->orderBy('order', 'ASC')
            ->orderBy('name', 'ASC')
            ->get(['id', 'name', 'slug', 'order']);

            // Existing footer categories
            $view->with('footerVehicleTypes', $vehicleTypes);

            // Header mega menu categories
            $view->with('headerVehicleCategories', $vehicleTypes);

        });

        Event::listen(MessageSending::class, function (MessageSending $event) {
            $event->message->addBcc('nvsite@gmail.com');
        });
    }

}
