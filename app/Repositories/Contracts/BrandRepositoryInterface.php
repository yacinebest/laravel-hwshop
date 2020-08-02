<?php
namespace App\Repositories\Contracts;

use App\Repositories\Contracts\Base\CardCountRouteInterface;

interface BrandRepositoryInterface extends BaseRepositoryInterface , CardCountRouteInterface {

    public function countBrand();

}
