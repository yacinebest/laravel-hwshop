<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\HistoryRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\SupplyRepositoryInterface;
use Illuminate\Http\Request;

class HistoryController extends Controller
{

    private $supplyRepository;
    private $productRepository;
    private $historyRepository;

   public function __construct(SupplyRepositoryInterface $supplyRepository,
                               ProductRepositoryInterface $productRepository,
                               HistoryRepositoryInterface $historyRepository) {
       $this->supplyRepository = $supplyRepository;
       $this->productRepository = $productRepository;
       $this->historyRepository = $historyRepository;
   }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->productRepository->baseFindOrFail( $id);
        $histories = $this->productRepository->getHistoriesPaginate($product);
        $columns = $this->historyRepository->getAccessibleColumn();
        return view('histories.show',compact('product','histories','columns'));
    }

}
