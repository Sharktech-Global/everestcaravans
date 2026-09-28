<?php

namespace App\Http\ViewComposers;

use App\Address;
use Illuminate\View\View;


class AddressComposer
{
    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if (!isset($view->getData()['address'])) {
            $view->with('address', Address::get());
        }
    }
}
