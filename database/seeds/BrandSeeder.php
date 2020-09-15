<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->delete();
        factory(\App\Models\Brand::class,15)->create();

        $counter = 1;
        $nth = 0;
        foreach (Category::all() as $category) {
            for ($i=$counter; $i > 0 ; $i--) {
                $brand = Brand::all()->get($nth);
                $category->brands()->attach($brand);
            }
            $counter++;
            $nth++;
            if($nth>14)
                $nth =0;
        }
        $nth = 1;
        foreach (Product::all() as $product) {
            $brand = $product->category->brands->random($nth)->first();
            if($brand)
                $product->brands()->attach($brand);
            else{
                $brand = factory(\App\Models\Brand::class)->create();
                $product->category->brands()->attach($brand);
                $product->brands()->attach($brand);
            }
            $nth++;
        }

    }
}
