<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location_Content extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'location_contents';

    public static function firstOrCreate()
    {
        $obj = static::first();
        return $obj ?: new static;
    }
}
