<?php

namespace App\Models;

use Carbon\Carbon;

class Supply extends BaseModel
{

    //
    protected $appends =['productName','hasBeenUsed'];
    protected $enumStatus = ['WAITING','IN PROGRESS','CANCELED','COMPLETED'];

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

    public function getHasBeenUsedAttribute(){
        return $this->status==$this->enumStatus[2] || $this->status==$this->enumStatus[3] ;
    }



}
