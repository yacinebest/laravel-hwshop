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
        $folder = "";
        if($this->imageable_type=="Category")
            $folder="categories";
        else if($this->imageable_type=="Product")
            $folder="products";
        return "/storage/uploads/". $folder ."/" . $this->file ;
    }

}
