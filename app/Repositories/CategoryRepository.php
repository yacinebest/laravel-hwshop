<?php
namespace App\Repositories;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Traits\Base\ReadTrait;

class CategoryRepository implements CategoryRepositoryInterface {
    use ReadTrait;

    public function paginate($number = 10){
        return $this->basePaginate($number,'Category');
    }

    public function getAccessibleColumn(){
        return [
            // 'id'=>'Id',
            'name'=>'Name',
            'parentName'=>'Parent',
            'created_at' => 'Created At'
        ];
    }
}
