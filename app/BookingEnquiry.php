<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingEnquiry extends Model
{
    protected $table = 'booking_enquiries';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'vehicle_id',
        'vehicle_name',
        'suburb',
        'state',
        'postcode',
        'additional_details',
    ];
}