<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleVarient extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    public function fuel()
    {
        return $this->belongsTo('App\Fuel');
    }

    public function transmission()
    {
        return $this->belongsTo('App\Transmission');
    }
    public function category()
    {
        return $this->hasMany('App\VehicleCategory','id','vehicle_variant_id');
    }
}
