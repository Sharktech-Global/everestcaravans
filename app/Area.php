<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Area extends Model
{
    use SearchableTrait;
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    public static function firstOrCreate()
    {
        $obj = static::first();
        return $obj ?: new static;
    }
    protected $searchable = [
        'columns' => [
            'areas.name' => 1,
            'locations.name' => 1,
        ],
        'joins' => [
            'locations' => ['locations.id', 'areas.location_id'],
        ],
    ];

    public function location()
    {
        return $this->belongsTo('App\Location');
    }
    public function type()
    {
        return $this->belongsTo('App\LocationType', 'location_type_id');
    }
}
