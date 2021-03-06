<?php

namespace App\Repositories\Contracts;

use App\Repositories\Contracts\Base\CardCountRouteInterface;

interface ProductRepositoryInterface extends BaseRepositoryInterface , CardCountRouteInterface{

    public function orderBySell($number = 0);
    public function orderByView($number = 0);

    public function attachBrandToProduct($brand,$product);
    public function detachAllBrandToProduct($product);

    public function getSupplies($product);
    public function getSuppliesPaginate($product);
    public function getHistoriesPaginate($product);

    public function attachSupplyToProduct($admission_price,$supply_date,$quantity,$product);
    public function attachHistoryToProduct($selling_price,$quantity,$product,$supply);

    public function countProduct();

    public function getCardCountAndRouteForShow($product);

    public function getProductsIdEqualToBrands($brands,$products);
    public function filterProductsWithoutBrands($id,$page,$request);
    public function filterProductsWithBrands($id,$page,$request);

    public function searchProducts($q,$nbr);
    public function filterProductForSearch($q,$page,$request);
}
