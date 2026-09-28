<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class SubscriptionEnquiry extends Model
{
    use SearchableTrait;
    use Uuids;
    public $incrementing = false;

    protected $searchable = [
        'columns' => [
            'subscription_enquiries.name' => 1,
            'subscription_enquiries.email' => 1,
            'subscription_enquiries.phone' => 1,
            'locations.name' => 1,
            'vehicles.name' => 1,
        ],
        'joins' => [
            'locations' => ['locations.id', 'subscription_enquiries.location_id'],
            'vehicles' => ['vehicles.id', 'subscription_enquiries.vehicle_id'],
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
