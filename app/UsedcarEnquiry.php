<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class UsedcarEnquiry extends Model
{
    use SearchableTrait;
    use Uuids;
    public $incrementing = false;

    protected $searchable = [
        'columns' => [
            'usedcars_enquiries.model' => 1,
            'usedcars_enquiries.name' => 1,
            'usedcars_enquiries.phone' => 1,
            'usedcars_enquiries.year' => 1,
            'locations.name' => 1,
        ],
        'joins' => [
            'locations' => ['locations.id', 'usedcar_enquiries.location_id'],
        ],
    ];
    public function location()
    {
        return $this->belongsTo('App\Location');
    }
}
