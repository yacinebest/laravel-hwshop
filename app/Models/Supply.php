<?php

namespace App\Models;


class Supply extends BaseModel
{

    //
    protected $appends =['productName'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

/*
|---------------------------------------------------------------------------|
| GETTER & SETTER                                                           |
|---------------------------------------------------------------------------|
*/

    public function getProductNameAttribute(){
        return $this->product->name;
    }
}