<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\DeliveryRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\PaymentRepositoryInterface;

class PaymentController extends Controller
{
    private $orderRepository;
    private $paymentRepository;
    private $deliveryRepository;

    public function __construct(OrderRepositoryInterface $orderRepository,
                                PaymentRepositoryInterface $paymentRepository,
                                DeliveryRepositoryInterface $deliveryRepository) {
        $this->orderRepository = $orderRepository;
        $this->paymentRepository = $paymentRepository;
        $this->deliveryRepository = $deliveryRepository;
    }

    public function showPaymentPage($id){
        $order = $this->orderRepository->baseFindOrFail( $id);
        $invoice = $order->invoice;
        return view('frontend.carts.payment',compact('order','invoice'));
    }

    public function payment(Request $request){
        $order = $this->orderRepository->baseFindOrFail( $request->input('order_id'));

        $payment = $this->paymentRepository->findPaymentByMethod($request->input('method'));
        $this->orderRepository->linkPaymentToOrder($order,$payment);

        $delivery = $this->deliveryRepository->createDelivery($order);
        $this->orderRepository->linkDeliveryToOrder($order,$delivery);

        return redirect(route('user.orders'));
    }
}
