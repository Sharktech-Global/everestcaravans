<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;


class CareerAbrecco extends Model
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
            'career_abreccos.name' => 1,
            'career_abreccos.email' => 1,
            'career_abreccos.phone' => 1,
        ]
    ];

    
    public function career()
    {
        return $this->belongsTo('App\Career','career_type','id');
    }

}
