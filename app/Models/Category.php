<?php

namespace App\Models;

class Category extends BaseModel
{
    // protected $with =['products','parent'] ;

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id');
    }

    public function brands()
    {
        return $this->belongsToMany('App\Models\Brand')
                                    ->using('App\Models\BrandCategory');
    }

    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }
}
