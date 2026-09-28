<?php

namespace App;

use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\Model;

class ExitPopupEnquiry extends Model
{
    use SearchableTrait;
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $searchable = [
        'columns' => [
            'exit_popup_enquiries.name' => 1,
            'exit_popup_enquiries.email' => 1,
            'exit_popup_enquiries.phone' => 1,
            'exit_popup_enquiries.location' => 1,
        ]
    ];
}
