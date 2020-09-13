<?php
namespace App\Repositories;

use App\Models\Invoice;
use App\Repositories\Contracts\InvoiceRepositoryInterface;

class InvoiceRepository extends BaseRepository implements InvoiceRepositoryInterface {

/*
|---------------------------------------------------------------------------|
| Override BaseRepository FUNCTION                                          |
|---------------------------------------------------------------------------|
*/
    public function getAccessibleColumn(){
        return [
            'ref'=>'Ref',
            'orderRef'=>'Order Ref',
            'quantity'=>'Quantity',
            'total_price'=>'Total Price',
            'file'=>'File'
        ];
    }

    public function getFillableColumn(){
        return [
            // 'method'=>'Method',
            // 'contact_info'=>'Contact Info',
            // 'phone_number'=>'Phone Number'
        ];
    }

/*
|---------------------------------------------------------------------------|
| CUSTOM FUNCTION                                                           |
|---------------------------------------------------------------------------|
*/
    public function createInvoice($order){
        $quantity = 0;
        $total_price = 0;
        foreach ($order->products as $product) {
            $quantity += $product->pivot->ordered_quantity ;
            $total_price += ($product->price * $product->pivot->ordered_quantity) ;
        }

        $invoice = factory(Invoice::class)->create([
            'quantity'=>$quantity,
            'total_price'=>$total_price
        ]);
        return $invoice;
    }
}
