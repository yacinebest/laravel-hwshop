<?php
namespace App\Repositories\Contracts;

use App\Repositories\Contracts\Base\ReadableColumnInterface;
use App\Repositories\Contracts\Base\ReadInterface;

interface CategoryRepositoryInterface extends ReadInterface , ReadableColumnInterface {
    public function paginate($number = 10);
}
