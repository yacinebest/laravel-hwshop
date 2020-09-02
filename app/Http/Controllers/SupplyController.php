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
        $history = $this->historyRepository->
                    baseCreate([
                        'supply_id'=>$supply->id,
                        'product_id'=>$request->input('product_id'),
                        'quantity'=> $request->input('quantity'),
                        'selling_price'=> $request->input('selling_price')
                    ]);

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

        $status = $request->input('status');
        $current_time = now()->format('Y-m-d H:m:s');
        switch ($status) {
            case ($this->supplyRepository->getEnumStatusSupply())[2]://canceled
            case ($this->supplyRepository->getEnumStatusSupply())[3]://completed
                $this->supplyRepository->update($supply,['ended_at'=>$current_time]);
                $this->historyRepository->update($supply->history,['ended_at'=>$current_time]);
                $this->productRepository->update($supply->product,['copy_number'=>0,'price'=>0]);
            break;

            case ($this->supplyRepository->getEnumStatusSupply())[1]://in progress
                $this->supplyRepository->update($supply,['started_at'=>$current_time]);
                $this->historyRepository->update($supply->history,['started_at'=>$current_time]);
                $this->productRepository->update($supply->product,
                        ['copy_number'=>$supply->quantity,'price'=>$supply->history->selling_price]
                    );
            break;
            default:
            break;
        }


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
