<?php

namespace App;

use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\Model;

class QuickEnquiry extends Model
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
            'quick_enquiries.name' => 1,
            'quick_enquiries.email' => 1,
            'quick_enquiries.phone' => 1,
            'locations.name' => 1,
        ],
        'joins' => [
            'locations' => ['locations.id', 'quick_enquiries.location_id'],
        ],
    ];

    public function location()
    {
        return $this->belongsTo('App\Location');
    }
    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle');
    }
}
