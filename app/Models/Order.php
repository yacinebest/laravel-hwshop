<?php

namespace App\Models;

use Carbon\Carbon;

class Order extends BaseModel
{
    // protected $with =['products'] ; //changed
    protected $appends =['userUsername','adminUsername','enumStatus','hasBeenVerified'];

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




/*
|---------------------------------------------------------------------------|
| GETTER & SETTER                                                           |
|---------------------------------------------------------------------------|
*/

    public function getUserUsernameAttribute()
    {
        return $this->user->username;
    }

    public function getAdminUsernameAttribute()
    {
        if($this->admin )
            return $this->admin->username;
        else
            return 'Not Yet';
    }

    public function getEnumStatusAttribute(){
        return [
            'APPROVED',
            'PROCESSING',
            'CANCELED'

        ];
    }

    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->format('Y-m-d h-m-s');
    }

    public function getUpdatedAtAttribute($value){
        return Carbon::parse($value)->format('Y-m-d h-m-s');
    }

    public function getHasBeenVerifiedAttribute($value){
        return $this->status=='CANCELED' || $this->status=='APPROVED' ;
    }

}
