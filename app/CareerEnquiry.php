<?php

namespace App;

use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\Model;

class CareerEnquiry extends Model
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
            'career_enquiries.name' => 1,
            'career_enquiries.email' => 1,
            'career_enquiries.phone' => 1,
        ]
    ];

    public function career()
    {
        return $this->belongsTo('App\Career','career_id ','id');
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }
}
