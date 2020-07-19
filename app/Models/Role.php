<?php

namespace App\Models;

class Role extends BaseModel
{
    // protected $with =['users'] ;
/*
|---------------------------------------------------------------------------|
| RELATIONSHIP                                                              |
|---------------------------------------------------------------------------|
*/
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

}
