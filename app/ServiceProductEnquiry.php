<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class ServiceProductEnquiry extends Model
{
    use SearchableTrait;
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $searchable = [
        'columns' => [
            'service_product_enquiries.name' => 1,
            'service_product_enquiries.email' => 1,
            'service_product_enquiries.phone' => 1,
            'locations.name' => 1,
            'service_products.name' => 1,
        ],
        'joins' => [
            'locations' => ['locations.id', 'service_product_enquiries.location_id'],
            'service_products' => ['service_products.id', 'service_product_enquiries.service_product_id'],
        ],
    ];

    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    public function service_product()
    {
        return $this->belongsTo('App\ServiceProduct');
    }
}
