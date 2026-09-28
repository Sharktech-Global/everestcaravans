<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use PhpParser\Node\Expr\Cast\Bool_;

class Location extends Model
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
            'locations.name' => 1,
            'locations.email' => 1,
            'locations.showroom' => 1,
            'locations.email_ccs' => 2,
            'locations.email_bccs' => 2,
            'locations.phone_numbers' => 2,
        ]
    ];

    public function type()
    {
        return $this->hasOne('App\LocationType', 'id','location_type_id');
    }
    public function state()
    {
        return $this->belongsTo('App\State', 'state_id');
    }
    public function area()
    {
        return $this->hasMany(Area::class, 'location_id');
    }
    public function locations()
    {
        return $this->hasMany('App\Booking','location_id','location_type_id');
    }
}
