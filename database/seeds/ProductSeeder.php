<?php

use App\Models\Category;
use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('products')->delete();

        // for ($i=0; $i < 5 ; $i++) {
        //     $category = Category::all()->random(1)->first();
        //     $product = factory(\App\Models\Product::class)->create(['category_id'=>$category->id]);
        //     $supply = factory(\App\Models\Supply::class)->create(['product_id'=>$product->id]);
        //     $history = factory(\App\Models\History::class)->create([
        //                             'product_id'=>$product->id,
        //                             'supply_id'=>$supply->id
        //                             ]);

        //     $supply->history_id = $history->id;
        // }
        DB::table('products')->delete();
        
        $counter = 1;
        foreach (Order::all() as $order) {
            $category = Category::all()->random(1)->first();
            for ($i=$counter; $i > 0 ; $i--) {
                $product = factory(\App\Models\Product::class)->create(['category_id'=>$category->id]);
                $order->products()->attach($product,['ordered_quantity'=>$counter*10]);
            }
            $counter++;
        }

    }
}
