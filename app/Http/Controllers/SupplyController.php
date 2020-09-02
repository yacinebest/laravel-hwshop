<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\SupplyRepositoryInterface;
use Illuminate\Http\Request;

class SupplyController extends Controller
{
     private $supplyRepository;
     private $productRepository;

    public function __construct(SupplyRepositoryInterface $supplyRepository,
                                ProductRepositoryInterface $productRepository) {
        $this->supplyRepository = $supplyRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entities = $this->supplyRepository->basePaginate();
        $supplies = $this->supplyRepository->basePaginate();
        $columns = $this->supplyRepository->getAccessibleColumn();
        $status =  $this->supplyRepository->getEnumStatusSupply();
        // $cardCountAndRoute = $this->productRepository->getCardCountAndRoute();
        return view('supplies.index',compact('supplies','columns','status'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $fillable_columns = $this->supplyRepository->getFillableColumn();
        $status =  ($this->supplyRepository->getEnumStatusSupplyWait())[0];
        $product = $this->productRepository->baseFindOrFail( $id);

        return view('supplies.create',compact('fillable_columns','status','product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->processRequestForStore($request);
        $supply = $this->supplyRepository->baseCreate( $data);

        return redirect(route('supply.show',$request->input('product_id')));
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
        $supplies = $this->productRepository->getSuppliesPaginate($product);
        $columns = $this->supplyRepository->getAccessibleColumn();
        $status =  $this->supplyRepository->getEnumStatusSupply();

        return view('supplies.show',compact('product','supplies','columns','status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $supply = $this->supplyRepository->baseFindOrFail( $id);
        $data = $this->processRequestForUpdate($request);
        $this->supplyRepository->update($supply,$data);

        return back()->withStatus(__('Supply successfully updated.'));
    }


/*
|---------------------------------------------------------------------------|
| CUSTOM FUNCTION                                                           |
|---------------------------------------------------------------------------|
*/

    public function processRequestForStore(Request $request){
        return $request->only(['product_id','admission_price','quantity','status','supply_date']);
    }

    public function processRequestForUpdate(Request $request){
        return $request->only(['status']);
    }
}
