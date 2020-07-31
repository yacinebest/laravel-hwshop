<?php
namespace App\Repositories\Contracts\Base;

interface ReadInterface{

    public function baseFindOrFail($id);

    public function baseAll();

    public function basePaginate($where = [],$order =['created_at'=>'DESC'],$number = 10);
    // public function basePaginate($column = 'created_at',$order = 'DESC',$number = 10);

    public function baseCount();
}
