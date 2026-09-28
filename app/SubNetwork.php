<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubNetwork extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    protected $table = 'sub_network';
    public static function firstOrCreate()
    {
        $obj = static::first();
        return $obj ?: new static;
    }
    public function main()
    {
        return $this->belongsTo('App\MainNetwork');
    }
    public function branch()
    {
        return $this->hasMany('App\NetworkBranch', 'sub_id');
    }
    public function brand()
    {
        return $this->hasOne('App\Brand','id','brand_id');

    }
}
