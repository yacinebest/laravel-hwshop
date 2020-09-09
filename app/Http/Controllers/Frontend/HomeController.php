<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository) {
        $this->productRepository = $productRepository;
    }

    public function home()
    {
        $productsOrderBy = ['Latest'=>$this->productRepository->orderByLatest(6),
                    'Best Sell'=>$this->productRepository->orderBySell(6),
                    'Most View'=>$this->productRepository->orderByView(6)
                    ] ;
        return view('frontend.home.home',compact('productsOrderBy'));
    }
}
