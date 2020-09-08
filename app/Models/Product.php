<?php

namespace App\Models;


class Product extends BaseModel
{
    // protected $appends =['imageCount','upVoteCount','downVoteCount','commentCount',
    //                     'isSupplyActive'];

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

    public function supplies()
    {
        return $this->hasMany('App\Models\Supply');
    }

    public function histories()
    {
        return $this->hasMany('App\Models\History');
    }

/*
|---------------------------------------------------------------------------|
| GETTER & SETTER                                                           |
|---------------------------------------------------------------------------|
*/

    // public function getCategoryNameAttribute(){
    //     return $this->category->name;
    // }

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
    public function getUpVoteCountAttribute()
    {
        return count($this->votes()->whereType('UP')->get());
    }
     /**
     * @return number
     */
    public function getDownVoteCountAttribute()
    {
        return count($this->votes()->whereType('DOWN')->get());
    }

     /**
     * @return number
     */
    public function getCommentCountAttribute()
    {
        return count($this->comments);
    }

     /**
     */
    public function getIsSupplyActiveAttribute()
    {
        $p = $this->supplies->filter(function($supply){
            return $supply->status == 'IN PROGRESS';
        });
        return !$p->isEmpty() ;
    }


    public function getSubPriceAttribute()
    {
        return (double)($this->price) * (double)( $this->pivot->ordered_quantity)    ;
    }

}
