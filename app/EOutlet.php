<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class EOutlet extends Model
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
            'e_outlets.spc_name' => 1,
            'e_outlets.spc_head' => 1,
            'e_outlets.spc_phone' => 1,
            'e_outlets.spc_email' => 1,
            'e_outlets.spc_address' => 1,
            'dealerships.name' => 1,
        ],
        'joins' => [
            'dealerships' => ['dealerships.id', 'e_outlets.dealership_id'],
        ],
    ];

    public function dealership()
    {
        return $this->belongsTo('App\Dealership');
    }
}
