<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class InsuranceEnquiry extends Model
{
    use SearchableTrait;
    use Uuids;
    public $incrementing = false;
    protected $searchable = [
        'columns' => [
            'insurance_enquiries.name' => 1,
            'insurance_enquiries.email' => 1,
            'insurance_enquiries.phone' => 1,
            'locations.name' => 1,
        ],
        'joins' => [
            'locations' => ['locations.id', 'insurance_enquiries.location_id'],
        ],
    ];

    public function location()
    {
        return $this->belongsTo('App\Location');
    }
}
