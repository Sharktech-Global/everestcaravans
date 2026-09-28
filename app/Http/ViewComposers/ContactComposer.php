<?php

namespace App\Http\ViewComposers;

use App\Contact;
use Illuminate\View\View;


class ContactComposer
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
        if (!isset($view->getData()['contact'])) {
            $view->with('contact', Contact::whereStatus(1)->get());
        }
    }
}
