<?php

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('supplies')->delete();

        for ($i=0; $i < 5 ; $i++) {
            $category = Category::all()->random(1)->first();
            $product = factory(\App\Models\Product::class)->create(['category_id'=>$category->id]);
            factory(\App\Models\Supply::class)->create(['product_id'=>$product->id]);
        }
    }
}
