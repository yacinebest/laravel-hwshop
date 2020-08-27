<?php

use App\Models\Category;
use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $counter = 1;
        foreach (Order::get()->take(5) as $order) {
            $category = Category::all()->random(1)->first();
            for ($i=$counter; $i > 0 ; $i--) {
                $product = factory(\App\Models\Product::class)->create(['category_id'=>$category->id]);
                $order->products()->attach($product,['ordered_quantity'=>$counter*10]);
            }
            $counter++;
        }
    }
}
