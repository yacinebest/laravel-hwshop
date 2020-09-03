<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    private $orderRepository;
    private $userRepository;

    public function __construct(OrderRepositoryInterface $orderRepository,
                                UserRepositoryInterface $userRepository) {
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->orderRepository->basePaginate();
        $columns = $this->orderRepository->getAccessibleColumn();
        // $cardCountAndRoute = $this->imageRepository->getCardCountAndRoute();
        return view('orders.index',compact('columns','orders'));
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
        $auth = $this->userRepository->getAuthUser();
        $order = $this->orderRepository->baseFindOrFail($id);
        $this->orderRepository->update($order,['status'=>$request->status,'admin_id'=>$auth->id]);
        return response()->json(['admin'=>$auth]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd($id);
        // $product = $this->productRepository->baseFindOrFail( $id);
        // $supplies = $this->productRepository->getSuppliesPaginate($product);
        // $columns = $this->supplyRepository->getAccessibleColumn();
        // $status =  $this->supplyRepository->getEnumStatusSupply();
        // return view('supplies.show',compact('product','supplies','columns','status'));
    }

    public function getProductRelat($id){
        $order = $this->orderRepository->baseFindOrFail($id);
        return response()->json($order->products);
    }
}
