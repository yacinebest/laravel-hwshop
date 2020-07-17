<?php

namespace App\Models;


class Product extends BaseModel
{
    // protected $with =['category'] ;

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order')
                                ->using('App\Models\OrderProduct')
                                ->withPivot(['ordered_quantity'])
                                ->withTimestamps();
    }

    public function brands()
    {
        return $this->belongsToMany('App\Models\Brand')
                                    ->using('App\Models\BrandProduct');
    }

    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function votes()
    {
        return $this->morphMany('App\Models\Vote', 'voteable');
    }

}
