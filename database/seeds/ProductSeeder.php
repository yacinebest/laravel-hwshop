<?php

use App\Models\Category;
use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function random_pic($dir='public/storage/uploads/datasheet')
    {
        $files = glob($dir . '/*.*');
        $file = array_rand($files);
        $name_file = last( explode('/', $files[$file]) );
        return ( explode('.', $name_file ) )[0];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->delete();

        $counter = 1;
        foreach (Order::all() as $order) {
            $category = Category::all()->random(1)->first();
            for ($i=$counter; $i > 0 ; $i--) {
                $product = factory(\App\Models\Product::class)->
                            create(['category_id'=>$category->id,'datasheet'=>$this->random_pic()]);
                $order->products()->attach($product,['ordered_quantity'=>$counter*10]);
            }
            $counter++;
        }

    }
}
