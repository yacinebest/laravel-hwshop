<?php
namespace App\Repositories\Contracts;

use App\Repositories\Contracts\Base\CardCountRouteInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface , CardCountRouteInterface  {

    public function getAuthUser();
    public function isAuthEqualTo($user);

    public function countOnlyUser();
    public function countOnlyAdmin();

    public function paginateOnlyAdmin($column = 'created_at',$order = 'DESC',$paginate = 10);
    public function paginateOnlyUser($column = 'created_at',$order = 'DESC',$paginate = 10);

    public function getReadOnlyColumn();
}
