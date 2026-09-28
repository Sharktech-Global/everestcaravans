<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicePage extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $table = 'services_pages';
    public $incrementing = false;

    public static function firstOrCreate()
    {
        $obj = static::first();
        return $obj ?: new static;
    }
}
