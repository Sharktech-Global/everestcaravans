<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    public static function getByKey($key)
    {
        $obj = static::where('key', $key)->first();
        return $obj ?: new static;
    }
    public static function getOtp($length)
    {
        return mt_rand(pow(10, ($length - 1)), pow(10, $length) - 1);
    }
}
