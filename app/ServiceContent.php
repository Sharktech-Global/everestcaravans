<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;


class ServiceContent extends Model
{
    use Uuids;
    use SearchableTrait;


    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    protected $searchable = [
        'columns' => [
            'service_contents.name' => 1,
        ]
    ];

    public function services()
    {
        return $this->hasOne('App\Service','id','service_id');
    }
}
