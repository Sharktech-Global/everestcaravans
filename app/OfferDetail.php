<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class OfferDetail extends Model
{
    use SearchableTrait;
    use Uuids;
    public $incrementing = false;

    protected $searchable = [
        'columns' => [
            'offer_details.offer' => 1,
            'states.name' => 1,
            'vehicles.name' => 1,
        ],
        'joins' => [
            'states' => ['states.id', 'offer_enquiries.state_id'],
            'vehicles' => ['vehicles.id', 'offer_enquiries.vehicle_id'],
        ],
    ];

    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle');
    }

    public function state()
    {
        return $this->belongsTo('App\State');
    }
}
