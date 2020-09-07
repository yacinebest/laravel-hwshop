<?php

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplyHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('supplies')->delete();
        DB::table('histories')->delete();

        foreach (Product::all() as $product) {
            $supply = factory(\App\Models\Supply::class)->create(['product_id'=>$product->id]);
            $history = factory(\App\Models\History::class)->create([
                                    'product_id'=>$product->id,
                                    'supply_id'=>$supply->id
                                    ]);

            $supply->history_id = $history->id;
            
            $supply->save();
            $history->save();
            $product->save();
        }


    }
}
