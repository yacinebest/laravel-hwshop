<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Str;

class BasePivot extends Pivot
{
     // Disable Incrementing
     public $incrementing = false;
     protected $guarded =[];

    //  protected static function boot(){
    //      parent::boot();
    //      static::creating(function($model){
    //          $model->{$model->getKeyName()} =(string)Str::uuid();
    //      });
    //  }
}
