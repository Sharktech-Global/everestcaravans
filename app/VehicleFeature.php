<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleFeature extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    public static function getByFeature($vehicle_id, $feature_id)
    {
        $obj = static::where('vehicle_id', $vehicle_id)->where('feature_id', $feature_id)->first();
        return $obj ?: new static;
    }

    public function feature()
    {
        return $this->belongsTo('App\Feature');
    }
}
