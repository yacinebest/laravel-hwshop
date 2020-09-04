<?php

use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('invoices')->delete();

        foreach (Order::all() as $order){
            $quantity = 0;
            $total_price = 0;
            foreach ($order->products as $product) {
                $quantity += $product->pivot->ordered_quantity ;
                $total_price += $product->price ;
            }

            $invoice = factory(\App\Models\Invoice::class)->create([
                'quantity'=>$quantity,
                'total_price'=>$total_price
            ]);

            $order->invoice()->associate($invoice);
            $order->save();
            $invoice->save();
        }
    }
}
