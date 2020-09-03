<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Http\Request;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface{

/*
|---------------------------------------------------------------------------|
| Override BaseRepository FUNCTION                                          |
|---------------------------------------------------------------------------|
*/
    public function getAccessibleColumn(){
        return [
            'ref'=>'Ref',
            'userUsername'=>'Order By',
            'adminUsername'=>'Verified By',
            'status'=>'Status',
            'order_date'=>'Order Date',
            'updated_at'=>'Updated At',
            'deliveryDate'=>'Delivery',
            'other'=>''
        ];
    }

/*
|---------------------------------------------------------------------------|
| CUSTOM FUNCTION                                                           |
|---------------------------------------------------------------------------|
*/

    public function getEnumStatusSupply(){
        return ['PROCESSING','CANCELED','APPROVED'];
    }

    public function linkDeliveryToOrder($order,$delivery){
        $order->delivery()->associate($delivery) ;
        $order->save();
        // $order->delivery_id = $delivery->id;
    }
}
