<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainNetwork extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    protected $table = 'main_network';
    public static function firstOrCreate()
    {
        $obj = static::first();
        return $obj ?: new static;
    }
    public function sub()
    {
        return $this->hasMany('App\SubNetwork', 'main_id');
    }

}
