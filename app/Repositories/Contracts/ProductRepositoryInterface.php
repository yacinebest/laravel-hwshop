<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface extends BaseRepositoryInterface{


    public function attachBrandToProduct($brand,$product);
    public function detachAllBrandToProduct($product);

    public function getComments($product);

}
