<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsurancePage extends Model
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

    public static function getBySlug($slug)
    {
        $obj = static::where('slug', $slug)->first();
        return $obj ?: new static;
    }
}
