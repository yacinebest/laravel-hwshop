<?php

namespace App\Models;

use App\Traits\Base\StringToModelNameTrait;

class Image extends BaseModel
{
    use StringToModelNameTrait;
    public function imageable()
    {
        return $this->morphTo();
    }


    public function getImageableTypeAttribute($value){
        return $this->explodeNameSpaceModels($value);
    }
}
