<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
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

    public function paginateElementWithFilter(Request $request,$id,$page){
        $category = $this->categoryRepository->baseFindOrFail($id);

        $products = null;
        if(json_decode($request->input('brands')) ){
            $products = $this->productRepository->filterProductsWithBrands($id,$page,$request);
        }else{
            $products = $this->productRepository->filterProductsWithoutBrands($id,$page,$request);
        }
        return ['products'=>$products,'nbr'=>$products->total()];
    }

}
