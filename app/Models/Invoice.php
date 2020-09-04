<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends BaseModel
{
    protected $appends =['orderRef'];

    public function order()
    {
        return $this->hasOne('App\Models\Order');
    }

/*
|---------------------------------------------------------------------------|
| GETTER & SETTER                                                           |
|---------------------------------------------------------------------------|
*/

    public function getOrderRefAttribute(){
        return $this->order->ref ;
    }
}
