<?php

namespace App;

use Nicolaslopezj\Searchable\SearchableTrait;
use Tzsk\Payu\Models\HasTransactions;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasTransactions;
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
            'bookings.first_name' => 1,
            'bookings.last_name' => 1,
            'bookings.email' => 1,
            'bookings.phone' => 1,
        ]
    ];

    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle');
    }

    public function payments()
    {   
        return $this->belongsTo(Payment::class, 'id', 'mihpayid');
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function cod()
    {
        return $this->hasOne('App\CodPayment');
    }

    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    public function federal_payments()
    {
        return $this->hasMany(FederalPayment::class, 'payable_id');
    }
}
