<?php
namespace App\Repositories\Contracts\Base;

interface ReadInterface{
    public function findOrFail($id,$model = null);

    public function all($model = null);
}
