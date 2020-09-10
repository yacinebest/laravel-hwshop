<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\BrandRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    private $productRepository;
    private $brandRepository;

    public function __construct(ProductRepositoryInterface $productRepository,
                                BrandRepositoryInterface $brandRepository) {
        $this->productRepository = $productRepository;
        $this->brandRepository = $brandRepository;
    }

    public function home()
    {
        $productsOrderBy = ['Latest'=>$this->productRepository->orderByLatest(6),
                    'Best Sell'=>$this->productRepository->orderBySell(6),
                    'Most Viewed'=>$this->productRepository->orderByView(6)
                    ] ;
        $brands = $this->brandRepository->defaultTake(12);
        return view('frontend.home.home',compact('productsOrderBy','brands'));
    }
}
