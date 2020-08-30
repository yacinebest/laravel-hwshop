<?php

namespace App\Models;

use Carbon\Carbon;

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

    public function getSupplyDateAttribute($value){
        return Carbon::parse($value)->format('Y-m-d');
    }
}
