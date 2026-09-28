<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleApplication extends Model
{
    use Uuids;
     /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
     public $incrementing = false;

     public function vehicle_type()
    {
        return $this->hasOne('App\VehicleType','id','vehicle_type_id');
    }
}
