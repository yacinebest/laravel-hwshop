<?php

namespace App\Repositories;

use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Traits\Base\ReadTrait;

class RoleRepository implements RoleRepositoryInterface  {
    use ReadTrait;

    // public function all($model = null){
    //    return $this->baseAll();
    // }
}
