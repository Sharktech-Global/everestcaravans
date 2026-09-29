<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Nicolaslopezj\Searchable\SearchableTrait;
class Service extends Model
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
    protected $searchable = [
        'columns' => [
            'services.title' => 1,
        ]
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function service_contents()
    {
        return $this->hasMany('App\ServiceContent');
    }
    public function services()
    {
        return $this->hasMany('App\ServiceEnquiry','id','service_name');
    }
}
