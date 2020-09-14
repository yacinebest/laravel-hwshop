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
            $q = $request->input('query');
            return redirect(route('search.products',$q));
        }
        else
            return redirect(route('home'));
    }

    public function searchProducts($search){
        return view('frontend.search.search',compact('search')) ;
    }

    public function apiSearch(Request $request,$search,$page){
        $products = $this->productRepository->filterProductForSearch($search,$page,$request);
        return ['products'=>$products,'nbr'=>$products->total()];
    }
}
