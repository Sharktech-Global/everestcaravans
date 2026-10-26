<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\VehicleType;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Event;
use Illuminate\Mail\Events\MessageSending;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

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

            $view->with('footerVehicleTypes', $vehicleTypes);

            $view->with('headerVehicleCategories', $vehicleTypes);
        });

        // BCC normal emails, excluding password reset messages.
        Event::listen(MessageSending::class, function (MessageSending $event) {

            $subject = $event->message->getSubject() ?? '';

            if (
                str_contains(strtolower($subject), 'reset password') ||
                str_contains(strtolower($subject), 'reset your password') ||
                str_contains(strtolower($subject), 'password reset')
            ) {
                return;
            }

            $event->message->addBcc('nvsite@gmail.com');
        });
    }
}