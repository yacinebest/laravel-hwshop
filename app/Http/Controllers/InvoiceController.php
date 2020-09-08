<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\InvoiceRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class InvoiceController extends Controller
{

    private $invoiceRepository;
    private $orderRepository;
    private $userRepository;

    public function __construct(InvoiceRepositoryInterface $invoiceRepository,
                                OrderRepositoryInterface $orderRepository,
                                UserRepositoryInterface $userRepository) {

        $this->invoiceRepository = $invoiceRepository;
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
        $invoices = $this->invoiceRepository->basePaginate();
        $columns = $this->invoiceRepository->getAccessibleColumn();

        return view('backend.invoices.index',compact('invoices','columns'));
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
        $user = $this->userRepository->baseFindOrFail($order->user->id);

        $customer = new Buyer([
            'name'          => $user->firstname . ' ' . $user->lastname,
            'address'       => $user->address,
            'code'          => $user->id,
            'phone'         => $user->phone_number,
            'custom_fields' => [
                'birth date' => $user->birth_date,
                'order number'=> $order->ref
            ],
        ]);


        $items = [];
        foreach ($order->products as $product) {
            array_push($items,
                        (new InvoiceItem())->title($product->name)
                            ->pricePerUnit($product->price)->quantity($product->pivot->ordered_quantity)
                    );
        }


        $invoice = Invoice::make('invoices')
            ->series('BIG')
            ->sequence($order->invoice->ref)
            ->buyer($customer)
            ->date(Carbon::parse($order->order_date))
            ->dateFormat('m/d/Y')
            ->payUntilDays(14)
            ->currencySymbol('DZ')
            ->currencyCode('DZA')
            ->currencyFormat('{VALUE}{SYMBOL}')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint(',')
            ->shipping($order->delivery->price)
            ->filename('INVOICE-BIG-' . $order->invoice->ref)
            ->addItems($items);

        return $invoice->stream();

    }

}
