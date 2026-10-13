<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FactoryVisit extends Model
{
    protected $table = 'factory_visits';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'visit_date',
        'visit_time',
        'suburb',
        'state',
        'postcode',
        'vehicle_name',
        'additional_requirements',
    ];

    protected $casts = [
        'visit_date' => 'date',
    ];
}