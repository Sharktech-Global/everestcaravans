<?php

namespace App;

use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\Model;

class OfferEnquiry extends Model
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
            'offer_enquiries.name' => 1,
            'offer_enquiries.email' => 1,
            'offer_enquiries.phone' => 1,
            'locations.name' => 1,
        ],
        'joins' => [
            'locations' => ['locations.id', 'offer_enquiries.location_id'],
        ],
    ];

    public function location()
    {
        return $this->belongsTo('App\Location');
    }
}
