<?php
namespace App\Traits\Base;

use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

trait CreateTraits
{
    public function baseCreate($model,$data)
    {
        if($model=='Category')
            return Category::create($data)->fresh();
        else
            throw new ModelNotFoundException('Model Not Found');
    }
}
