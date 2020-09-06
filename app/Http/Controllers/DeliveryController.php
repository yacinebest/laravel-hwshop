<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\DeliveryRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{

    private $deliveryRepository;
    private $orderRepository;

    public function __construct(DeliveryRepositoryInterface $deliveryRepository,
                                OrderRepositoryInterface $orderRepository) {
        $this->deliveryRepository = $deliveryRepository;
        $this->orderRepository = $orderRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $fillable_columns = $this->deliveryRepository->getFillableColumn();
        $order = $this->orderRepository->baseFindOrFail($id);
        // dd([$order,$fillable_columns]);
        return view('deliveries.create',compact('fillable_columns','order'));
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
        $delivery = $this->deliveryRepository->baseCreate( $data);

        $order = $this->orderRepository->baseFindOrFail($request->input('order_id'));

        $this->orderRepository->linkDeliveryToOrder($order,$delivery);

        return redirect(route('order.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

/*
|---------------------------------------------------------------------------|
| CUSTOM FUNCTION                                                           |
|---------------------------------------------------------------------------|
*/

    public function processRequestForStore(Request $request){
        return $request->only(['delivery_society','price','phone_number','delivery_date']);
    }


}
