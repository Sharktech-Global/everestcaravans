<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;


    protected $fillable = ['category_id', 'name', 'status'];

    protected $searchableFields = ['*'];

    protected $table = 'sub_categories';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function vehicleCategory()
    {
        return $this->belongsTo(
            VehicleCategory::class,
            'id',
            'sub_category_id'
        );
    }
    
}
