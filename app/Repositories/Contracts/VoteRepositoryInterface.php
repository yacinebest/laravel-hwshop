<?php
namespace App\Repositories\Contracts;

use App\Repositories\Contracts\Common\ReadInterface;

interface VoteRepositoryInterface extends BaseRepositoryInterface {

    public function otherFindOrFail($id,$model = null);
}
