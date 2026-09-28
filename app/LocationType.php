<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocationType extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    public function type()
    {
        return $this->hasMany('App\Location', 'location_type_id','id');
    }
}
