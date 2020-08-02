<?php
namespace App\Repositories;

use App\Models\Brand;
use App\Repositories\Contracts\BrandRepositoryInterface;

class BrandRepository extends BaseRepository implements BrandRepositoryInterface {

/*
|---------------------------------------------------------------------------|
| Override BaseRepository FUNCTION                                          |
|---------------------------------------------------------------------------|
*/
    public function getAccessibleColumn(){
        return [
            'logo'=>'Logo',
            'name'=>'Name',
            'created_at' => 'Created At',
        ];
    }

    public function getFillableColumn(){
        return [
            'name'=>'Name',
        ];
    }

    public function getCardCountAndRoute(){
        return [
            'Brand'=>['count'=>$this->countBrand(),'route'=>'brand.index'],
        ];
    }

/*
|---------------------------------------------------------------------------|
| Override Interface FUNCTION                                               |
|---------------------------------------------------------------------------|
*/

    public function countBrand(){
        return count(Brand::all());
    }
}
