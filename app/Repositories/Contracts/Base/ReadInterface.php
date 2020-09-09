<?php
namespace App\Repositories\Contracts\Base;

interface ReadInterface{

    public function baseFindOrFail($id);

    public function baseAll();

    public function baseOrderBy($order =['created_at'=>'DESC']);
    public function baseTake($elements,$number = 0);

    public function basePaginate($where = [],$order =['created_at'=>'DESC'],$number = 10);
    public function defaultPaginate($result,$number = 10);

    public function baseCount();
}
