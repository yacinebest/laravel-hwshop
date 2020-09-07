<?php

namespace App\Models;

class Brand extends BaseModel
{
    protected $appends =['categoriesCount','productsCount'];

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

/*
|---------------------------------------------------------------------------|
| GETTER & SETTER                                                           |
|---------------------------------------------------------------------------|

    /**
     * @return number
     */
    public function getCategoriesCountAttribute()
    {
        return $this->categories ? count($this->categories) : 0;
    }

    /**
     * @return number
     */
    public function getProductsCountAttribute()
    {
        return $this->products ?  count($this->products) : 0;
    }
}
