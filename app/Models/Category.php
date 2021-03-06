<?php

namespace App\Models;

use Illuminate\Support\Collection;

class Category extends BaseModel
{
    protected $appends =['directChildCount'];
    protected $with= ['brands'];
    // protected $appends =['childCount','imageCount','productCount'];

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

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

    public function getProductCountAttribute()
    {
        return count($this->products);
    }

    public function getImageAttribute(){
        return $this->images()->first() ;
    }

    public function getDirectChildCountAttribute(){
        return $this->childs ?  count($this->childs) : 0;
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

    public function getParentsAttribute()
    {
        $sections = new Collection();
        $category = $this;
        while($category->parent_id!=null){
            $category = Category::findOrFail($category->parent_id);
            $sections->prepend($category);
        }
        return $sections;
    }

}
