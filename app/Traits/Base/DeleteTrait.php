<?php

namespace App\Traits\Base;

trait DeleteTrait{
    public function delete($entity){
        $entity->delete();
    }
}
