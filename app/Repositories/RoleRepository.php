<?php

namespace App\Repositories;

use App\Repositories\Contracts\RoleRepositoryInterface;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface  {


/*
|---------------------------------------------------------------------------|
| Override BaseRepository FUNCTION                                          |
|---------------------------------------------------------------------------|
*/

    public function getFillableColumn(){
        return [
            'type'=>'Type',
        ];
    }
}
