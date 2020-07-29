<?php
namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Traits\Base\CreateTraits;
use App\Traits\Base\DeleteTrait;
use App\Traits\Base\ReadTrait;
use App\Traits\Base\UpdateTrait;
use Illuminate\Http\Request;

class CategoryRepository implements CategoryRepositoryInterface {
    use ReadTrait{
        findOrFail as baseFindOrFail;
    }
    use CreateTraits;
    use UpdateTrait;
    use DeleteTrait;


    private $categoryRequest = ['name'];

    public function paginate($number = 10){
        return $this->basePaginate($number,'Category');
    }

    public function getAccessibleColumn(){
        return [
            // 'id'=>'Id',
            'name'=>'Name',
            'level'=>'Level',
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
        if($request->has('parent_id')) {
            $this->categoryRequest = array_merge($this->categoryRequest,['parent_id','level']) ;
            $request['level'] = $this->getLevelCategory($request['parent_id']) + 1;
        }
        return $this->baseCreate('Category',$request->only($this->categoryRequest));
    }



    public function getLevelCategory($id){
        return Category::findOrFail($id)->level;
    }

    public function findOrFail($id,$model = null){
        return $this->baseFindOrFail($id,'Category');
    }


    public function getCardCountAndRoute(){

        $level=1;
        $cardCountAndRoute= [];
        do {
            $cardCountAndRoute['Level '.$level]=['count'=>count(Category::where('level',$level)->get()) , 'route'=>'category.index' ] ;
            $level++;
        } while (count(Category::where('level',$level)->get())>0);


        return $cardCountAndRoute ;
    }

    public function getBaseCategories()
    {
        return Category::with('childs')->where('parent_id',null)->get();
    }
    public function allCategories(){
        return $this->all('Category');
    }

    public function getCategoriesLevels(){
        $level=1;
        $categories_level= [];
        do {
            $categories_level[$level]=Category::where('level',$level)->get();
            $level++;
        } while (count(Category::where('level',$level)->get())>0);
        return $categories_level;
    }

    public function getDirectParents(Category $category){
        $selected_categories= [];
        $parent_id = $category->parent_id;
        for ($i=$category->level -1; $i > 0 && $parent_id!=null ; $i--) {
            $selected_categories['select_'.$i] = $this->findOrFail($parent_id);
            $parent_id = $selected_categories['select_'.$i]->parent_id;
        }
        return $selected_categories;
    }


    public function updateCategoriesWithChilds($category,Request $request)
    {

        $oldLevel = $category->level;

        $level =  ($request->parent_id ? $this->findOrFail($request->parent_id)->level + 1 : 1  );
        $this->update($category,['name'=>$request->name,'parent_id'=> $request->parent_id,'level'=>$level]);
        $category->refresh();
        $currentLevel = $category->level;

        if( $currentLevel != $oldLevel){
            foreach($category->getAllChilds() as $child) {
                $child->update(['level'=>$currentLevel + ($child->level - $oldLevel ) ]) ;
                $child->refresh();
            }
        }
    }

    public function deleteWithChilds($entity){
        foreach($entity->getAllChilds() as $child) {
            $this->delete($child);
        }
        $this->delete($entity);
    }
}
