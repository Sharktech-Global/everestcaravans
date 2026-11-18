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
        'next_action',
        'location',
        'whatsapp_number',
        'source_url',
    ];

    public function modelLabel(): string
    {
        return [
            '19.6' => 'Warrior 19.6 ft',
            '21.6' => 'Warrior 21.6 ft',
            'both' => 'Both models',
            '19.5' => 'Warrior 19.5 ft',
            '21.5' => 'Warrior 21.5 ft',
            'custom' => 'Custom',
            'compare_both' => "I'd like to compare both",
        ][$this->preferred_model] ?? $this->preferred_model;
    }
}