<?php

namespace App\Http\ViewComposers;

use App\Location;
use App\VehicleType;
use App\Service;
use Illuminate\View\View;

class VehicleTypeComposer
{
    public $vehicle_types_data = [];
    public $web_services = [];
    public $locations_footer = [];
    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->vehicle_types_data = VehicleType::whereStatus(1)->orderBy('order')->select('id','name','image','slug')->get();
        $this->web_services = Service::select('title','slug')->where('status', 1)->orderBy('order','ASC')->get();
        $this->locations_footer = Location::select('name','icon2','banner_image','content','address')->orderBy('order','ASC')->where('status', 1)->get();
    //  dd($this->vehicle_types_data);
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if (!isset($view->getData()['vehicle_types_data'])) {
            $view->with('vehicle_types_data', $this->vehicle_types_data);
        }

        if (!isset($view->getData()['web_services'])) {
            $view->with('web_services', $this->web_services);
        }

        if (!isset($view->getData()['locations_footer'])) {
            $view->with('locations_footer', $this->locations_footer);
        }
    }
}
