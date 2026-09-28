<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Nicolaslopezj\Searchable\SearchableTrait;

class VehicleAllFeatureImage extends Model
{
    use Uuids;
    public $incrementing = false;
}
