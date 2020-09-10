<?php

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{

    
    function random_pic($dir='public/storage/uploads/products')
    {
        $files = glob($dir . '/*.*');
        $file = array_rand($files);
        return last( explode('/', $files[$file]) );
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->delete();

        foreach (Product::all() as $product) {
            $product->images()->create(['file'=>$this->random_pic()]);
            $product->images()->create(['file'=>$this->random_pic()]);
        }

        foreach (Category::all() as $category) {
            $category->images()->create(['file'=>$this->random_pic()]);
            $category->images()->create(['file'=>$this->random_pic()]);
        }
    }
}
