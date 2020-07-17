<?php

namespace App\Models;

class Brand extends BaseModel
{
    public function products()
    {
        return $this->belongsToMany('App\Models\Product')
                                    ->using('App\Models\BrandProduct');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category')
                                    ->using('App\Models\BrandCategory');
    }

    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }
}
