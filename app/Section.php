<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Section extends Model
{
    use SearchableTrait;
    use Uuids;

    public $incrementing = false;


    public function contents()
    {
        return $this->hasMany('App\SectionContent','section_id','id');
    }
}
