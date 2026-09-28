<?php

namespace App;

use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\Model;

class VehicleEnquiry extends Model
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
            'vehicle_enquiries.name' => 1,
            'vehicle_enquiries.email' => 1,
            'vehicle_enquiries.phone' => 1,
            'locations.name' => 1,
            'vehicles.name' => 1,
        ],
        'joins' => [
            'locations' => ['locations.id', 'vehicle_enquiries.location_id'],
            'vehicles' => ['vehicles.id', 'vehicle_enquiries.vehicle_id'],
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
