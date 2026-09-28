<?php

namespace App;

use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
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
            'exchanges.model' => 1,
            'exchanges.name' => 1,
            'exchanges.phone' => 1,
            'exchanges.year' => 1,
            'locations.name' => 1,
        ],
        'joins' => [
            'locations' => ['locations.id', 'exchanges.location_id'],
        ],
    ];
    public function location()
    {
        return $this->belongsTo('App\Location');
    }
}
