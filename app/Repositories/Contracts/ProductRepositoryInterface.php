<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface extends BaseRepositoryInterface{


    public function attachBrandToProduct($brand,$product);
    public function detachAllBrandToProduct($product);

    public function getComments($product);
    public function getSupplies($product);
    public function getSuppliesPaginate($product);
    public function getHistoriesPaginate($product);

    public function attachSupplyToProduct($admission_price,$supply_date,$quantity,$product);
    public function attachHistoryToProduct($selling_price,$quantity,$product,$supply);
}
