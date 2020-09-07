<?php

namespace App\Models;

use Illuminate\Support\Collection;

class Category extends BaseModel
{
    protected $appends =['childCount','imageCount','productCount'];

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    // public function parent()
    // {
    //     return $this->belongsTo('App\Models\Category', 'parent_id');
    // }
    public function childs()
    {
        return $this->hasMany('App\Models\Category', 'parent_id');
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


/*
|---------------------------------------------------------------------------|
| GETTER & SETTER                                                           |
|---------------------------------------------------------------------------|
*/

    /**
     * @return number
     */
    public function getChildCountAttribute()
    {
        return count($this->getAllChilds());
    }

    /**
     * @return number
     */
    public function getImageCountAttribute()
    {
        return count($this->images);
    }

    /**
     * @return number
     */
    public function getProductCountAttribute()
    {
        return count($this->products);
    }

/*
|---------------------------------------------------------------------------|
| CUSTOM FUNCTION                                                           |
|---------------------------------------------------------------------------|
*/

    public function getAllChilds()
    {
        $sections = new Collection();

        foreach ($this->childs as $section) {
            $sections->push($section);
            $sections = $sections->merge($section->getAllChilds());
        }

        return $sections;
    }

}
