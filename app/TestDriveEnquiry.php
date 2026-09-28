<?php

namespace App;

use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\Model;

class TestDriveEnquiry extends Model
{
    use SearchableTrait;
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

   

    public function location()
    {
        return $this->belongsTo('App\Location');
    }
    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle');
    }

}
