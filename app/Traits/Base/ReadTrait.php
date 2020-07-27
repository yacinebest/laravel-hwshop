<?php
namespace App\Traits\Base;

use App\Models\Category;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\User as Authenticatable;

trait ReadTrait{
    public function findOrFail($id,$model = null){
        if($model=='User')
            return User::findOrFail($id);
        else if($model=='Category')
            return Category::findOrFail($id);
        else
            throw new ModelNotFoundException('Entity Not Found');
    }

    public function all($model = null){
        if($model=='User')
            return User::all();
        else if($model=='Role')
            return Role::all();
        else if($model=='Category')
            return Category::all();
        else
            throw new ModelNotFoundException('Model Not Found');
    }

    public function basePaginate($number = 10,$model = null){
        if($model=='User')
            return User::paginate($number);
        if($model=='Role')
            return Role::paginate($number);
        if($model=='Category')
            return Category::paginate($number);
        else
            throw new ModelNotFoundException('Model Not Found');
    }
}
