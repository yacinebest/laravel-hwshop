<?php
namespace App\Repositories\Contracts;

use App\Repositories\Contracts\Base\CreateInterface;
use App\Repositories\Contracts\Base\DeleteInterface;
use App\Repositories\Contracts\Base\ReadableColumnInterface;
use App\Repositories\Contracts\Base\ReadInterface;
use App\Repositories\Contracts\Base\UpdateInterface;

interface BaseRepositoryInterface extends ReadInterface , CreateInterface , DeleteInterface , UpdateInterface , ReadableColumnInterface {

}
