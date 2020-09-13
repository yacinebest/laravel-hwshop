<?php
namespace App\Repositories;

use App\Models\Order;
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
            'deliveryDate'=>'Delivery Stat',
            'payment'=>'Payment Mtd'
        ];
    }

/*
|---------------------------------------------------------------------------|
| CUSTOM FUNCTION                                                           |
|---------------------------------------------------------------------------|
*/
    public function getAccessibleColumnForShow(){
        return [
            'userUsername'=>'Order By',
            'adminUsername'=>'Verified By',
            'status'=>'Status',
            'order_date'=>'Order Date',
            'updated_at'=>'Updated At',
            'deliveryDate'=>'Delivery Stat',
            'payment'=>'Payment Mtd'
        ];
    }

    public function getEnumStatusSupply(){
        return ['PROCESSING','CANCELED','APPROVED'];
    }

    public function linkDeliveryToOrder($order,$delivery){
        $order->delivery()->associate($delivery) ;
        $order->save();
    }

    public function linkPaymentToOrder($order,$payment){
        $order->payment()->associate($payment) ;
        $order->save();
    }

    public function linkInvoiceToOrder($order,$invoice){
        $order->invoice()->associate($invoice) ;
        $order->save();
    }

    public function createOrder($user){
        return factory(Order::class)->create(['user_id'=>$user->id]);
    }
}
