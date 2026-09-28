<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NetworkBranch extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    protected $table = 'network_branches';
    public static function firstOrCreate()
    {
        $obj = static::first();
        return $obj ?: new static;
    }
    public function main()
    {
        return $this->belongsTo('App\MainNetwork');
    }
    public function sub()
    {
        return $this->belongsTo('App\SubNetwork');
    }
    public function brand()
    {
        return $this->hasOne('App\Brand','id','brand_id');

    }
}
