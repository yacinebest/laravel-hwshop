<?php
namespace App\Traits\Base;

trait UpdateTrait{
    public function update($entity,$data){
        return $entity->update($data);
    }
}