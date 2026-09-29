<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Cviebrock\EloquentSluggable\Sluggable;

class Section extends Model
{
    use SearchableTrait;
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

    public function contents()
    {
        return $this->hasMany('App\SectionContent','section_id','id');
    }
}
