<?php
namespace App\Repositories\Contracts\Base;


interface UpdateInterface{
    public function update($entity,$data);
}