<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class VehicleEdition extends Model
{
    use Uuids;
    use Sluggable;

    public $incrementing = false;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    public function sections()
    {
        return $this->hasMany('App\VehicleEditionSection');
    }
}