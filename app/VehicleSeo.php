<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleSeo extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    public static function getByVehicle($vehicle_id)
    {
        $obj = static::where('vehicle_id', $vehicle_id)->first();
        return $obj ?: new static;
    }
}
