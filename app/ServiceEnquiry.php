<?php

namespace App;

use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\Model;

class ServiceEnquiry extends Model
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
            'service_enquiries.name' => 1,
            'service_enquiries.phone' => 1,
            'locations.name' => 1,
        ],
        'joins' => [
            'locations' => ['locations.id', 'service_enquiries.location_id'],
        ],
    ];

    public function location()
    {
        return $this->belongsTo('App\Location');
    }

   
    public function service()
    {
        return $this->hasOne('App\Service', 'id', 'service_name');
    }
}
