<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends BaseModel
{

    protected $appends =['productName','supplyName'];
/*
|---------------------------------------------------------------------------|
| RELATIONSHIP                                                              |
|---------------------------------------------------------------------------|
*/
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function supply()
    {
        return $this->belongsTo('App\Models\Supply');
    }

/*
|---------------------------------------------------------------------------|
| GETTER & SETTER                                                           |
|---------------------------------------------------------------------------|
*/

    public function getProductNameAttribute(){
        return $this->product->name;
    }

    public function getSupplyRefAttribute(){
        return $this->supply->ref;
    }
}
