<?php
namespace App\Repositories\Contracts\Base;

interface ReadInterface{

    public function baseFindOrFail($id);

    public function baseAll();

    public function basePaginate($number = 10);
}
