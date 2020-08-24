<?php

namespace App\Models;

use App\Traits\Base\StringToModelNameTrait;

class Image extends BaseModel
{
    use StringToModelNameTrait;

    protected $appends =['imagePath'];

    public function imageable()
    {
        return $this->morphTo();
    }


    public function getImageableTypeAttribute($value){
        return $this->explodeNameSpaceModels($value);
    }

      /**
     */
    public function getImagePathAttribute()
    {
        return "/storage/uploads/categories/" . $this->file ;
    }

}
