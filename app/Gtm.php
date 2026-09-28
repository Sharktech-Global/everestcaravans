<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gtm extends Model
{
    public $incrementing = false;
    public static function firstOrCreate()
    {
        $obj = static::first();
        return $obj ?: new static;
    }
}
