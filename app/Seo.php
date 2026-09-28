<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;


class Seo extends Model
{
    use Uuids;
    use SearchableTrait;

    public $incrementing = false;
}
