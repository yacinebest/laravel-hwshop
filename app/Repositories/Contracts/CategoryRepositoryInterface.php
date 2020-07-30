<?php
namespace App\Repositories\Contracts;

use App\Models\Category;
use Illuminate\Http\Request;

interface CategoryRepositoryInterface {

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
