<?php
namespace App\Repositories\Contracts;

use App\Repositories\Contracts\Base\CreateInterface;
use App\Repositories\Contracts\Base\ReadableColumnInterface;
use App\Repositories\Contracts\Base\ReadInterface;
use App\Repositories\Contracts\Base\UpdateInterface;
use Illuminate\Http\Request;

interface CategoryRepositoryInterface extends ReadInterface , ReadableColumnInterface ,CreateInterface , UpdateInterface {
    public function paginate($number = 10);

    public function getFillableColumn();

    public function create(Request $request);

    public function getLevelCategory($id);
}
