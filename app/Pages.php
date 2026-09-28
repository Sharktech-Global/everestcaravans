<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;

class Pages extends Model
{
    protected $guarded = [];

    use SEOToolsTrait;

    public static function findBySlug($var, $location_content)
    {
        if ($var) {
            return new Pages([
                SEOMeta::setTitle(Str::title(str_replace('-', ' ', $var))),
                'title' => Str::title(str_replace('-', ' ', $var)),
                'content' => @$location_content->content,
                'slug' => $var,
            ]);
        } else {
            abort(404);
        }
    }
}
