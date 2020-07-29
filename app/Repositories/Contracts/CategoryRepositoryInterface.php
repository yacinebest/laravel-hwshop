<?php
namespace App\Repositories\Contracts;

use App\Models\Category;
use App\Repositories\Contracts\Base\CreateInterface;
use App\Repositories\Contracts\Base\DeleteInterface;
use App\Repositories\Contracts\Base\ReadableColumnInterface;
use App\Repositories\Contracts\Base\ReadInterface;
use App\Repositories\Contracts\Base\UpdateInterface;
use Illuminate\Http\Request;

interface CategoryRepositoryInterface extends ReadInterface , ReadableColumnInterface ,CreateInterface , UpdateInterface , DeleteInterface {
    public function paginate($number = 10);

    public function getFillableColumn();

    public function create(Request $request);

    public function getLevelCategory($id);

    public function getCardCountAndRoute();

    public function getBaseCategories();

    public function allCategories();

    public function getCategoriesLevels();

    public function getDirectParents(Category $category);

    public function updateCategoriesWithChilds($category,Request $request);

    public function deleteWithChilds($entity);
}
