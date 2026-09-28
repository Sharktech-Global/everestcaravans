<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;


class SectionContent extends Model
{
    use Uuids;
    use SearchableTrait;

    public $incrementing = false;
}
