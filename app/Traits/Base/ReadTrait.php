<?php
namespace App\Traits\Base;

use App\Models\Category;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\User as Authenticatable;

trait ReadTrait{
    use StringToModelNameTraits;

    public function baseFindOrFail($id){
        $modelClass= $this->convertVariableToModelName( explode('Repository',class_basename($this))[0]);
        return  $modelClass::findOrFail($id);
    }

    public function baseAll(){
        $modelClass= $this->convertVariableToModelName( explode('Repository',class_basename($this))[0]);
        return  $modelClass::all();
    }


    public function basePaginate($number = 10){

        $modelClass= $this->convertVariableToModelName( explode('Repository',class_basename($this))[0]);
        return  $modelClass::paginate($number);
    }

    // public function findOrFail($id,$model = null){
    //     $modelClass= $this->convertVariableToModelName( explode('Repository',class_basename($this))[0]);
    //     return  $modelClass::findOrFail($id);
    //     // if($model=='User')
    //     //     return User::findOrFail($id);
    //     // else if($model=='Category')
    //     //     return Category::findOrFail($id);
    //     // else
    //     //     throw new ModelNotFoundException('Entity Not Found');
    // }

    // public function all($model = null){
    //     $modelClass= $this->convertVariableToModelName( explode('Repository',class_basename($this))[0]);
    //     return  $modelClass::all();
    //     // if($model=='User')
    //     //     return User::all();
    //     // else if($model=='Role')
    //     //     return Role::all();
    //     // else if($model=='Category')
    //     //     return Category::all();
    //     // else
    //     //     throw new ModelNotFoundException('Model Not Found');
    // }

    // public function basePaginate($number = 10,$model = null){

    //     $modelClass= $this->convertVariableToModelName( explode('Repository',class_basename($this))[0]);
    //     return  $modelClass::paginate($number);
    //     // if($model=='User')
    //     //     return User::paginate($number);
    //     // else if($model=='Role')
    //     //     return Role::paginate($number);
    //     // else if($model=='Category')
    //     //     return Category::paginate($number);
    //     // else
    //     //     throw new ModelNotFoundException('Model Not Found');
    // }


}
