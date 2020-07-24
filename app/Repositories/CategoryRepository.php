<?php
namespace App\Repositories;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Traits\Base\CreateTraits;
use App\Traits\Base\ReadTrait;
use Illuminate\Http\Request;

class CategoryRepository implements CategoryRepositoryInterface {
    use ReadTrait;
    use CreateTraits;


    private $categoryRequest = ['name'];

    public function paginate($number = 10){
        return $this->basePaginate($number,'Category');
    }

    public function getAccessibleColumn(){
        return [
            // 'id'=>'Id',
            'name'=>'Name',
            'created_at' => 'Created At'
        ];
    }

    public function getFillableColumn(){
        return [
            // 'id'=>'Id',
            'name'=>'Name',
            // 'parent_id'=>'Parent',
        ];
    }

    public function create(Request $request){
        if($request->has('parent_id')) $this->categoryRequest = array_merge($this->categoryRequest,['parent_id']) ;
        return $this->baseCreate('Category',$request->only($this->categoryRequest));
    }
}
