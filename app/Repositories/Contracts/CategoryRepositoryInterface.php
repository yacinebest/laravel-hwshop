<?php
namespace App\Repositories\Contracts;

use App\Repositories\Contracts\Base\CreateInterface;
use App\Repositories\Contracts\Base\ReadableColumnInterface;
use App\Repositories\Contracts\Base\ReadInterface;
use Illuminate\Http\Request;

interface CategoryRepositoryInterface extends ReadInterface , ReadableColumnInterface ,CreateInterface {
    public function paginate($number = 10);

    public function getFillableColumn();

    public function create(Request $request);
}
