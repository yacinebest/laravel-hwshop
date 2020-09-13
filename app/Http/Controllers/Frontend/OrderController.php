<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\InvoiceRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;

class OrderController extends Controller
{
    private $orderRepository;
    private $userRepository;
    private $productRepository;
    private $invoiceRepository;

    public function __construct(OrderRepositoryInterface $orderRepository,
                                UserRepositoryInterface $userRepository,
                                ProductRepositoryInterface $productRepository,
                                InvoiceRepositoryInterface $invoiceRepository) {
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->invoiceRepository = $invoiceRepository;
    }

    public function order(Request $request){
        if(!Auth::check())
            return ['redirect' => route('login.user'),'login'=>true];
        else{
            $user = $this->userRepository->getAuthUser();
            $order = $this->orderRepository->createOrder($user);

            foreach ($request->all() as $item) {
                $product = $this->productRepository->baseFindOrFail( $item['id']);
                $this->productRepository->update($product,
                        ['copy_number'=>$product->copy_number - $item['quantity']]);
                $order->products()->attach($product,['ordered_quantity'=>$item['quantity']]);
            }

            $invoice = $this->invoiceRepository->createInvoice($order);
            $this->orderRepository->linkInvoiceToOrder($order,$invoice);

            return ['redirect' => route('payment',$order->id),'login'=>false];
        }
    }
}
