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
            // 'logo'=>'Logo',
            // 'name'=>'Name',
            // 'created_at' => 'Created At',
        ];
    }

    public function getFillableColumn(){
        return [
            'delivery_society'=>'Delivery Society',
            // 'delivery_date'=>'Delivery Date',
            'phone_number'=>'Phone Number'
        ];
    }
}
