<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;

class SearchController extends Controller
{
     private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository) {
        $this->productRepository = $productRepository;
    }

    public function search(Request $request){
        if($request->input('query')){
            $products = $this->productRepository->searchProducts($request->input('query'),10);
            $nbr_product = $products->total();
            $q = $request->input('query');
            return view('frontend.search.search',compact('products','nbr_product','q')) ;
        }
        else
            return redirect(route('home'));
    }

    public function apiSearch(Request $request,$search,$page){
        $products = $this->productRepository->filterProductForSearch($search,$page,$request);
        return ['products'=>$products,'nbr'=>$products->total()];
    }
}
