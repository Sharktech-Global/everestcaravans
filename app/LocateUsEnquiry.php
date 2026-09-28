<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class LocateUsEnquiry extends Model
{
    use SearchableTrait;
    use Uuids;
    public $incrementing = false;
    protected $searchable = [
        'columns' => [
            'locate_us_enquiries.name' => 1,
            'locate_us_enquiries.email' => 1,
            'locate_us_enquiries.phone' => 1,
            'locations.name' => 1,
        ],
        'joins' => [
            'locations' => ['locations.id', 'locate_us_enquiries.location_id'],
        ],
    ];
    public function location()
    {
        return $this->belongsTo('App\Location');
    }
}
