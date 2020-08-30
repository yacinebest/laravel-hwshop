<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\SupplyRepositoryInterface;
use Illuminate\Http\Request;

class SupplyController extends Controller
{
     private $supplyRepository;

    public function __construct(SupplyRepositoryInterface $supplyRepository) {
        $this->supplyRepository = $supplyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entities = $this->supplyRepository->basePaginate();
        $columns = $this->supplyRepository->getAccessibleColumn();
        // $cardCountAndRoute = $this->productRepository->getCardCountAndRoute();
        return view('supplies.index',compact('entities','columns'));
    }

}
