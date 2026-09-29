<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Nicolaslopezj\Searchable\SearchableTrait;

class Vehicle extends Model
{
    use SearchableTrait;
    use Sluggable;
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $fillable = [
        'name',
        'slug',
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $searchable = [
        'columns' => [
            'vehicles.name' => 1,
            'vehicles.slug' => 1,
        ]
    ];

    public function colors()
    {
        return $this->hasMany('App\VehicleColor');
    }

    public function varients()
    {
        return $this->hasMany(VehicleVarient::class)->where('status', 1);
    }

    public function sections()
    {
        return $this->hasMany('App\VehicleSection','vehicle_id','id');
    }
    public function contents()
    {
        return $this->hasMany('App\VehicleContent');
    }
    public function faqs()
    {
        return $this->hasMany('App\VehicleFaq');
    }
    public function editions()
    {
        return $this->hasMany('App\VehicleEdition');
    }
    public function features()
    {
        return $this->hasMany('App\VehicleFeature');
    }

    public function allfeatures()
    {
        return $this->hasMany('App\VehicleAllFeature');
    }

    public function specifications()
    {
        return $this->hasMany('App\VehicleSpecification');
    }
    public function seo()
    {
        return $this->hasOne('App\VehicleSeo');
    }

    public function categories()
    {
        return $this->hasMany('App\VehicleCategory');
    }

    public function vehicle_type()
    {
        return $this->belongsTo(VehicleType::class);
    }
    
}
