<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    public function lists()
    {
        return $this->hasMany('App\SpecificationList')->where('status', 1);
    }
}
