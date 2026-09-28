<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    public static function firstOrCreate()
    {
        $obj = static::first();
        return $obj ?: new static;
    }
}
