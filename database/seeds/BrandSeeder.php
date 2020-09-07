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
        foreach (Product::all() as $product) {
            for ($i=$counter; $i > 0 ; $i--) {
                $brand = factory(\App\Models\Brand::class)->create();
                $product->brands()->attach($brand);
            }
            if($counter<3)
                $counter++;
            else
                $counter=1;
        }

        $counter = 1;
        foreach (Category::all() as $category) {
            for ($i=$counter; $i > 0 ; $i--) {
                $brand = Brand::all()->random(1)->first();
                $category->brands()->attach($brand);
            }
            $counter++;
        }

    }
}
