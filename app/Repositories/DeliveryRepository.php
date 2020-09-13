<?php
namespace App\Repositories;

use App\Models\Delivery;
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

/*
|---------------------------------------------------------------------------|
| CUSTOM FUNCTION                                                           |
|---------------------------------------------------------------------------|
*/
    public function createDelivery($order){
        return factory(Delivery::class)->create([
            'delivery_date'=> \Carbon\Carbon::parse($order->order_date)->addWeeks(2)->format('Y-m-d h-m-s')
            ]);
    }
}
