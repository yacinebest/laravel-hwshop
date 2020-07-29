<?php
namespace App\Repositories\Contracts\Base;

interface ReadInterface{
    // public function findOrFail($id,$model = null);
    public function baseFindOrFail($id);

    // public function all($model = null);
    public function baseAll();

    public function basePaginate($number = 10);
    // public function basePaginate($number = 10,$model = null);
}
