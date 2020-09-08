<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\DeliveryRepositoryInterface;
use App\Repositories\Contracts\InvoiceRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    private $orderRepository;
    private $userRepository;
    private $deliveryRepository;
    private $invoiceRepository;
    private $paymentRepository;

    public function __construct(OrderRepositoryInterface $orderRepository,
                                UserRepositoryInterface $userRepository,
                                DeliveryRepositoryInterface $deliveryRepository,
                                InvoiceRepositoryInterface $invoiceRepository,
                                PaymentRepositoryInterface $paymentRepository) {
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
        $this->deliveryRepository = $deliveryRepository;
        $this->invoiceRepository = $invoiceRepository;
        $this->paymentRepository = $paymentRepository;
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
        $status = $this->orderRepository->getEnumStatusSupply();
        return view('orders.index',compact('columns','orders','status'));
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
        if($request->status=='PROCESSING')
            $status_delivery = 'WAITING';
        else if($request->status=='APPROVED')
            $status_delivery = 'IN PROGRESS';
        else
            $status_delivery = $request->status;

        $this->deliveryRepository->update($order->delivery,['status'=>$status_delivery]);
        return back()->withStatus(__('Order successfully updated.'));
        // return response()->json(['admin'=>$auth]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = $this->orderRepository->baseFindOrFail($id);
        $status = $this->orderRepository->getEnumStatusSupply();
        $columns = $this->orderRepository->getAccessibleColumnForShow();

        $columns_invoice = $this->invoiceRepository->getAccessibleColumn();
        $invoice = $order->invoice;
        
        $columns_delivery = $this->deliveryRepository->getAccessibleColumn();
        $delivery = $order->delivery;

        $columns_payment = $this->paymentRepository->getAccessibleColumn();
        $payment = $order->payment;
        return view('orders.show',compact('order','columns','columns_invoice','status','invoice','delivery','columns_delivery'
                                        ,'payment','columns_payment'));
    }

    public function getProductRelat($id){
        $order = $this->orderRepository->baseFindOrFail($id);
        return response()->json($order->products);
    }
}
