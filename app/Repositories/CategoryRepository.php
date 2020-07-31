<?php
namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface {

    private $categoryRequest = ['name'];
/*
|---------------------------------------------------------------------------|
| Override BaseRepository FUNCTION                                          |
|---------------------------------------------------------------------------|
*/
    public function getAccessibleColumn(){
        return [
            'name'=>'Name',
            'level'=>'Level',
            'childCount' => 'All Childs',
            'created_at' => 'Created At',
        ];
    }

    public function getFillableColumn(){
        return [
            'name'=>'Name',
        ];
    }

/*
|---------------------------------------------------------------------------|
| Override Interface FUNCTION                                               |
|---------------------------------------------------------------------------|
*/

    public function getCardCountAndRoute(){

        $level=1;
        $cardCountAndRoute= [];
        do {
            $cardCountAndRoute['Level '.$level]=['count'=>count(Category::where('level',$level)->get()) , 'route'=>'category.indexLevel','attribute'=>$level] ;
            $level++;
        } while (count(Category::where('level',$level)->get())>0);


        return $cardCountAndRoute ;
    }

    public function getLevelCategory($id){
        return Category::findOrFail($id)->level;
    }

    public function getBaseCategories()
    {
        return Category::with('childs')->where('parent_id',null)->get();
    }

    public function getCategoriesWhereLevel($level)
    {
        return Category::where('level',$level)->get();
    }

    public function getDirectParents(Category $category){
        $selected_categories= [];
        $parent_id = $category->parent_id;
        for ($i=$category->level -1; $i > 0 && $parent_id!=null ; $i--) {
            $selected_categories['select_'.$i] = $this->baseFindOrFail($parent_id);
            $parent_id = $selected_categories['select_'.$i]->parent_id;
        }
        return $selected_categories;
    }



    public function getCategoriesLevels(){
        $level=1;
        $categories_level= [];
        do {
            $categories_level[$level]= $this->getCategoriesWhereLevel($level);
            $level++;
        } while (count(Category::where('level',$level)->get())>0);
        return $categories_level;
    }

    public function updateWithChilds($category,Request $request)
    {

        $oldLevel = $category->level;

        $level =  ($request->parent_id ? $this->baseFindOrFail($request->parent_id)->level + 1 : 1  );
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
