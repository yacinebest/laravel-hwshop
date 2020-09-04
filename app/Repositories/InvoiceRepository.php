<?php
namespace App\Repositories;

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
}
