<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleCategory extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $table = 'vehicle_categories';

    public static function getByDetails($vehicle_id,$vehicle_variant_id,$category_type_id,$category_id,$sub_category_id)
    {
        $obj = static::where('vehicle_id', $vehicle_id)->where('vehicle_variant_id', $vehicle_variant_id)->where('category_type_id',$category_type_id)->where('category_id',$category_id)->where('sub_category_id',$sub_category_id)->first();
        return $obj ?: new static;
    }

    public function categoryTypes()
    {
        return $this->hasMany(CategoryType::class, 'id', 'category_type_id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'id', 'category_id');
    }

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class, 'id', 'sub_category_id');
    }
    public function vehicle()
    {
        return $this->hasOne(Vehicle::class,'id','vehicle_id');
    }
    public function vehicleVerient()
    {
        return $this->hasOne(VehicleVarient::class,'id','vehicle_variant_id');
    }
    
}
