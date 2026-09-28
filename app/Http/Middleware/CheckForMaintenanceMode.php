<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;

class CheckForMaintenanceMode extends Middleware
{
    /**
     * The URIs that should be reachable while maintenance mode is enabled.
     *
     * @var array
     */
    protected $except = [
        //
    ];
    public function handle($request, Closure $next)
    {
        if ($this->app->isDownForMaintenance() &&
            !in_array($request->ip(), [
                '116.68.102.167', //my ip Add your allowed IP addresses here
                '111.92.73.122',
                '157.44.215.159',  
                '27.97.171.198',
                '115.246.240.45',
                '42.107.193.43'
            ])) {
                return response()->view('errors.503', [], 503);
        }

        return $next($request);
    }
}
