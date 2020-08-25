<?php
namespace App\Repositories\Contracts;

use App\Models\Category;
use App\Repositories\Contracts\Base\CardCountRouteInterface;
use Illuminate\Http\Request;

interface CategoryRepositoryInterface extends BaseRepositoryInterface , CardCountRouteInterface {

    public function getLevelCategory($id);

    public function getBaseCategories();

    public function getCategoriesWhereLevel($level);

    public function getDirectParents(Category $category);

    public function getCategoriesLevels();

    public function updateWithChilds($category,Request $request);

    public function deleteWithChilds($entity);

}
