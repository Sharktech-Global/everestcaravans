<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleSpecification extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    public static function getBySpecification($vehicle_id, $specification_id)
    {
        $obj = static::where('vehicle_id', $vehicle_id)->where('specification_id', $specification_id)->first();
        return $obj ?: new static;
    }

    public function specification()
    {
        return $this->belongsTo('App\Specification');
    }
}
