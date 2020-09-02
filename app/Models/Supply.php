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

    public function history()
    {
        return $this->belongsTo('App\Models\History');
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

    public function getStartedAtAttribute($value){
        return $value ? Carbon::parse($value)->format('Y-m-d') : 'Not Yet';
    }

    public function getEndedAtAttribute($value){
        return $value ? Carbon::parse($value)->format('Y-m-d') : 'Not Yet';
    }

}
