<?php

namespace App\Repositories;

use App\Models\History;
use App\Models\Product;
use App\Models\Supply;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface {


/*
|---------------------------------------------------------------------------|
| Override BaseRepository FUNCTION                                          |
|---------------------------------------------------------------------------|
*/
    public function getAccessibleColumn(){
        return [
            'name'=>'Name',
            'price'=>'Price',
            'updated_price_at'=>'Updated Price At',
            'copy_number'=>'Quantity',
            // 'view'=>'View',
            'categoryName'=>'Category',

            'columnCount' => '',
            // 'brands' => 'Brands',

            // 'imageCount'=>'Images',
            // 'commentCount'=>'Comment',
            // 'upVoteCount'=> 'Up Vote',
            // 'downVoteCount'=> 'Down Vote'
            // 'category_id'=>'Category',
        ];
    }

    public function getFillableColumn(){
        return [
            // 'name'=>'Name',
            // 'price'=>'Price',
            // 'copy_number'=>'Copy Number',
            // 'category_id'=>'Category',
        ];
    }

    public function getCardCountAndRoute(){
        return [
            'Product'=>['count'=>$this->countProduct(),'route'=>'product.index'],
        ];
    }
/*
|---------------------------------------------------------------------------|
| Override Interface FUNCTION                                               |
|---------------------------------------------------------------------------|
*/

    public function getCardCountAndRouteForShow($product){
        return [
            'Supply'=>['count'=> $product->supplies ? count($product->supplies) : 0 ,'route'=>'supply.show','attribute'=>$product->id],
            'History'=>['count'=> $product->histories ? count($product->histories) : 0 ,'route'=>'history.show','attribute'=>$product->id],
        ];
    }

    public function attachBrandToProduct($brand,$product){
        $product->brands()->attach($brand);
    }

    public function detachAllBrandToProduct($product){
        $product->brands()->detach();
    }

    public function getComments($product){
        return $product->comments ;
    }

    public function getSupplies($product){
        return $product->supplies;
    }

    public function getSuppliesPaginate($product){
        return $this->defaultPaginate($product->supplies());
    }

    public function getHistoriesPaginate($product){
        return $this->defaultPaginate($product->histories());
    }

    public function attachSupplyToProduct($admission_price,$supply_date,$quantity,$product){
        $supply =
                factory(Supply::class)->create([
                    'product_id'=>$product->id,
                    'admission_price'=>$admission_price,
                    'quantity'=>$quantity,
                    'supply_date'=>$supply_date,
                    'started_at'=>now()->format('Y-m-d H:m:s'),
                    'status'=>'IN PROGRESS'
                ]);

        $product->supplies()->save($supply);
        return $supply;
    }

    public function attachHistoryToProduct($selling_price,$quantity,$product,$supply){
        $history =
                factory(History::class)->create([
                    'product_id'=>$product->id,
                    'supply_id'=>$supply->id,
                    'quantity'=>$quantity,
                    'selling_price'=>$selling_price,
                    'started_at'=>now()->format('Y-m-d H:m:s')
                ]);

        $product->histories()->save($history);
        return $history;
    }

    public function orderBySell($number = 0){
        $entities = Product::get()->sortByDesc('quantitySold');
        return $entities->take($number)->values();
    }

    public function orderByView($number = 0){
        $entities = $this->baseOrderBy(['view'=>'DESC']);
        return $this->baseTake($entities,$number);
    }

/*
|---------------------------------------------------------------------------|
| Override Interface FUNCTION                                               |
|---------------------------------------------------------------------------|
*/

    public function countProduct(){
        return count(Product::all());
    }
}
