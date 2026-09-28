<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryType extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $fillable = ['name', 'status'];

    protected $searchableFields = ['*'];

    protected $table = 'category_types';

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function vehicleCategory()
    {
        return $this->belongsTo(
            VehicleCategory::class,
            'id',
            'category_type_id'
        );
    }
}
