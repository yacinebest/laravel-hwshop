<?php

namespace App\Repositories;

use App\Models\Supply;
use App\Repositories\Contracts\ProductRepositoryInterface;

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
            'copy_number'=>'Copy Number',
            'view'=>'View',
            'categoryName'=>'Category',
            'columnCount' => 'Count',
            'brands' => 'Brands',
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

/*
|---------------------------------------------------------------------------|
| Override Interface FUNCTION                                               |
|---------------------------------------------------------------------------|
*/


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

    public function attachSupplyToProduct($admission_price,$supply_date,$quantity,$product){
        $product->supplies()->save(
            factory(Supply::class)->create(['product_id'=>$product->id,
                                            'admission_price'=>$admission_price,
                                            'quantity'=>$quantity,
                                            'supply_date'=>$supply_date,
                                            'status'=>'IN PROGRESS'])
        );
    }

}
