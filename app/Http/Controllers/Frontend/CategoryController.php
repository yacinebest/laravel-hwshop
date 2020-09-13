<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryRepository;
    private $productRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository,
                                ProductRepositoryInterface $productRepository) {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    public function category($id){
        $category = $this->categoryRepository->baseFindOrFail($id);
        $productsOrderBy = ['Most Viewed'=>$this->productRepository->orderByView(20)] ;
        $nbr_product = $category->productCount ;
        $products = $category->products()->paginate(6)->values();
        return view('frontend.categories.category',compact('category','productsOrderBy','nbr_product','products'));
    }

    public function paginateElement($id){
        $category = $this->categoryRepository->baseFindOrFail($id);
        $products = $category->products()->paginate(2);
        return $products;

        // $category = $this->categoryRepository->baseFindOrFail($id);
        // return Category::with('brands')->get();
    }

}
