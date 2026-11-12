<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WarriorEnquiry extends Model
{
    protected $table = 'warrior_enquiries';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'postcode',
        'preferred_model',
        'purchase_timeframe',
        'enquiry_type',
        'source_url',
    ];

    /**
     * The landing page stores the model as a short key so the column stays
     * tidy; the emails and the admin list want the label a buyer would read.
     */
    public function modelLabel(): string
    {
        return [
            '19.5' => 'Warrior 19.5 ft',
            '21.5' => 'Warrior 21.5 ft',
            'both' => 'Both models',
        ][$this->preferred_model] ?? $this->preferred_model;
    }
}
