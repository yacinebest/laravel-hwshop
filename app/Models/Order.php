<?php

namespace App\Models;


class Order extends BaseModel
{
    protected $with =['user'] ;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product')
                                    ->using('App\Models\OrderProduct')
                                    ->withPivot(['ordered_quantity'])
                                    ->withTimestamps();
    }
}
