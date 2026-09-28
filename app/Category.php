<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;


    protected $fillable = ['category_type_id', 'name', 'status'];

    protected $searchableFields = ['*'];

    public function categoryType()
    {
        return $this->belongsTo(CategoryType::class);
    }

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function vehicleCategory()
    {
        return $this->belongsTo(VehicleCategory::class, 'id', 'category_id');
    }
}
