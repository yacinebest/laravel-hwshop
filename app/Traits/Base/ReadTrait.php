<?php
namespace App\Traits\Base;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\User as Authenticatable;

trait ReadTrait{    
    public function findOrFail($id,$model = null){
        if($model=='User')
            return User::findOrFail($id);
        else
            throw new ModelNotFoundException('Entity Not Found');
    }

    public function all($model = null){
        if($model=='User')
            return User::all();
        if($model=='Role')
            return Role::all();
        else
            throw new ModelNotFoundException('Model Not Found');
    }
}
