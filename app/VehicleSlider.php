<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class VehicleSlider extends Model
{
    use Uuids;
    use Sluggable;

    public $incrementing = false;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle');
    }
}