<?php

namespace App;

use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\Model;

class HomeEnquiry extends Model
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
            'home_enquiries.name' => 1,
            'home_enquiries.email' => 1,
            'home_enquiries.phone' => 1,
            'home_enquiries.location' => 1,
        ]
    ];

    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle');
    }
}
