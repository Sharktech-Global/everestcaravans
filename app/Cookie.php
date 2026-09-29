<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cookie extends Model
{
    use Uuids;
    public $incrementing = false;

    protected $table = 'cookies';
    public static function firstOrCreate()
    {
        $obj = static::first();
        return $obj ?: new static();
    }
}
