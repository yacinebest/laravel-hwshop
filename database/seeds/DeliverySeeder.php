<?php

use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('deliveries')->delete();

        foreach (Order::all() as $order){

            $delivery = factory(\App\Models\Delivery::class)->create([
                'delivery_date'=> Carbon\Carbon::parse($order->order_date)->addWeeks(2)->format('Y-m-d h-m-s')
            ]);

            $order->delivery()->associate($delivery);
            $order->save();
            $delivery->save();
        }
    }
}
