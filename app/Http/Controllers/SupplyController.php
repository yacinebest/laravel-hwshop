<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\HistoryRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\SupplyRepositoryInterface;
use Illuminate\Http\Request;

class SupplyController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $fillable_columns = $this->supplyRepository->getFillableColumn();
        $status =  ($this->supplyRepository->getEnumStatusSupplyWait())[0];
        $product = $this->productRepository->baseFindOrFail( $id);

        return view('backend.supplies.create',compact('fillable_columns','status','product'));
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

        $data = $this->processRequestForCreateHistory($request,$supply);
        $history = $this->historyRepository->baseCreate($data);

        $this->supplyRepository->linkHistoryToSupply($supply,$history);

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
        $status =  $this->supplyRepository->getEnumStatusSupply();
        $columns_supply = $this->supplyRepository->getAccessibleColumn();
        return view('backend.supplies.show',compact('product','supplies','columns_supply','status'));
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

        $this->supplyRepository->updateChangeStatusWithRelat($request->input('status'),$supply);

        return back()->withStatus(__('Supply successfully updated.'));
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supply = $this->supplyRepository->baseFindOrFail( $id);
        if($supply->status != ($this->supplyRepository->getEnumStatusSupply())[1]){//in progress
            $this->supplyRepository->delete($supply->history);
            $this->supplyRepository->delete($supply);
        }
        return redirect()->back();
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

    public function processRequestForCreateHistory(Request $request,$supply){
        return [
            'supply_id'=>$supply->id,
            'product_id'=>$request->input('product_id'),
            'quantity'=> $request->input('quantity'),
            'selling_price'=> $request->input('selling_price')
        ];
    }
}
