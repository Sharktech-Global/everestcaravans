<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *  
     * @var bool
     */
    public $incrementing = false;
}
