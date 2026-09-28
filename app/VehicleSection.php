<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class VehicleSection extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    public function images()
    {
        return $this->hasMany('App\VehicleSectionImage');
    }

    public function getSlugAttribute()
    {
        return Str::slug($this->title, '-');
    }
}
