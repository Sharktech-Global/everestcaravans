<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
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
        return $this->hasMany('App\FeatureList')->where('status', 1);
    }
}
