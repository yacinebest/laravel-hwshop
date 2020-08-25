<?php

namespace App\Repositories;

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

}
