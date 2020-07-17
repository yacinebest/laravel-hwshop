<?php

namespace App\Models;

class Image extends BaseModel
{
    public function imageable()
    {
        return $this->morphTo();
    }
}
