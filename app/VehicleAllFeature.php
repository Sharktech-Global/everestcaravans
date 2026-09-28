<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Nicolaslopezj\Searchable\SearchableTrait;

class VehicleAllFeature extends Model
{
    use Uuids;
    public $incrementing = false;


    public function image_files(){
        return $this->hasOne('App\VehicleAllFeatureImage','vehicle_feature_id','id');
    }
}
