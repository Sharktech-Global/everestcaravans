<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleEdition extends Model
{
    use Uuids;
    public $incrementing = false;

    public function sections()
    {
        return $this->hasMany('App\VehicleEditionSection');
    }
}
