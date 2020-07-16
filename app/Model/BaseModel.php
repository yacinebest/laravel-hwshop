<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BaseModel extends Model
{
    // Disable Incrementing
    public $incrementing = false;
    protected $guarded =[];

    protected static function boot(){
        parent::boot();
        static::creating(function($model){
            $model->{$model->getKeyName()} =(string)Str::uuid();
        });
    }
}
