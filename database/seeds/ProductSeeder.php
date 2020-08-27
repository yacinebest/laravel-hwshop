<?php

use App\Models\Category;
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
        DB::table('products')->delete();

        for ($i=0; $i < 5 ; $i++) {
            $category = Category::all()->random(1)->first();
            factory(\App\Models\Product::class)->create(['category_id'=>$category->id]);
        }
    }
}
