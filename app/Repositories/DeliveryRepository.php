<?php
namespace App\Repositories;

use App\Repositories\Contracts\DeliveryRepositoryInterface;

class DeliveryRepository extends BaseRepository implements DeliveryRepositoryInterface {

/*
|---------------------------------------------------------------------------|
| Override BaseRepository FUNCTION                                          |
|---------------------------------------------------------------------------|
*/
    public function getAccessibleColumn(){
        return [
            'ref'=>'Ref',
            'delivery_society'=>'Delivery Society',
            'price'=>'Price',
            'delivery_date'=>'Delivery Date',
            'phone_number'=>'Phone Number',
            'status'=>'Status'
        ];
    }

    public function getFillableColumn(){
        return [
            'delivery_society'=>'Delivery Society',
            // 'price'=>'Price',
            // 'delivery_date'=>'Delivery Date',
            'phone_number'=>'Phone Number'
        ];
    }
}
