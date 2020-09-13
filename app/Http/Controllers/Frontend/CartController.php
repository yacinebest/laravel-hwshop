<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repositories\Contracts\DeliveryRepositoryInterface;
use App\Repositories\Contracts\InvoiceRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    private $orderRepository;
    private $userRepository;
    private $productRepository;
    private $paymentRepository;
    private $invoiceRepository;
    private $deliveryRepository;

    public function __construct(OrderRepositoryInterface $orderRepository,
                                UserRepositoryInterface $userRepository,
                                ProductRepositoryInterface $productRepository,
                                PaymentRepositoryInterface $paymentRepository,
                                InvoiceRepositoryInterface $invoiceRepository,
                                DeliveryRepositoryInterface $deliveryRepository) {
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->paymentRepository = $paymentRepository;
        $this->invoiceRepository = $invoiceRepository;
        $this->deliveryRepository = $deliveryRepository;
    }

    public function cart(){
        return view('frontend.carts.cart');
    }

    public function order(Request $request){
        if(!Auth::check())
            return ['redirect' => route('login.user'),'login'=>true];

        $user = $this->userRepository->getAuthUser();
        $order = $this->orderRepository->createOrder($user);

        foreach ($request->all() as $item) {
            $product = $this->productRepository->baseFindOrFail( $item['id']);
            $order->products()->attach($product,['ordered_quantity'=>$item['quantity']]);
        }
        return ['redirect' => route('payment',$order->id),'login'=>false];
    }

    public function showPaymentPage($id){
        $order = $this->orderRepository->baseFindOrFail( $id);
        return view('frontend.carts.payment',compact('order'));
    }

    public function payment(Request $request){
        $order = $this->orderRepository->baseFindOrFail( $request->input('order_id'));

        $payment = $this->paymentRepository->findPaymentByMethod($request->input('method'));
        $this->orderRepository->linkPaymentToOrder($order,$payment);

        $invoice = $this->invoiceRepository->createInvoice($order);
        $this->orderRepository->linkInvoiceToOrder($order,$invoice);

        $delivery = $this->deliveryRepository->createDelivery($order);
        $this->orderRepository->linkDeliveryToOrder($order,$delivery);

        return redirect(route('profile'));
    }

}
