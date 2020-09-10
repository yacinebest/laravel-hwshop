<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository) {
        $this->productRepository = $productRepository;
    }

    public function product($id)
    {
        $product = $this->productRepository->baseFindOrFail( $id);
        $productsOrderBy = ['Most Viewed'=>$this->productRepository->orderByView(20)] ;
        return view('frontend.products.product',compact('product','productsOrderBy')) ;
    }
}
