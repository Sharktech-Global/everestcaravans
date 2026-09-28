<?php

namespace App\Http\ViewComposers;

use App\Vehicle;
use Illuminate\View\View;

class VehicleComposer
{
    public $vehicles = [];
    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->vehicles = Vehicle::where('status', 1)->orderBy('order','ASC')->get();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if (!isset($view->getData()['vehicles'])) {
            $view->with('vehicles', end($this->vehicles));
        }
    }
}
