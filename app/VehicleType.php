<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;


    protected $fillable = ['slug', 'name', 'status'];

    protected $searchableFields = ['*'];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
    public function vehicle_applications()
    {
        return $this->belongsTo(VehicleApplication::class);
    }
}
