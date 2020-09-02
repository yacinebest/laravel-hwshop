<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class SupplyHistoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Product::get()->take(5) as $product) {
            $supply = factory(\App\Models\Supply::class)->create(['product_id'=>$product->id]);
            $history = factory(\App\Models\History::class)->create([
                                    'product_id'=>$product->id,
                                    'supply_id'=>$supply->id
                                    ]);

            $supply->history_id = $history->id;
        }
    }
}
