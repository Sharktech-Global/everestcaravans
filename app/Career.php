<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Career extends Model
{
    use SearchableTrait;
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $searchable = [
        'columns' => [
            'careers.title' => 1,
            'careers.location' => 1,
        ]
    ];
    public function careers()
    {
        return $this->hasMany('App\Career','career_id ','id');
    }

}
