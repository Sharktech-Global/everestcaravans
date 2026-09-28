<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model

{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle','vehicle_name','name');
    }
}
