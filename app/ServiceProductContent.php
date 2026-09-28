<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceProductContent extends Model
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
    protected $table = 'service_product_contents';

    public static function firstOrCreate()
    {
        $obj = static::first();
        return $obj ?: new static;
    }
}
