<?php
namespace App\Repositories\Contracts;

use App\Repositories\Contracts\Base\DeleteInterface;
use App\Repositories\Contracts\Base\ReadInterface;
use App\Repositories\Contracts\Base\UpdateInterface;

interface UserRepositoryInterface  extends DeleteInterface , ReadInterface ,UpdateInterface {

    public function getAuthUser();

    public function getAllUserCount();
    public function getAdminCount();
    public function getUserCount();

    public function getAccessibleColumn();
    public function getCardCountAndRoute();
    
    
    public function defaultReadWithPagination($column = 'created_at',$order = 'DESC',$paginate = 10);

    public function ReadAdminWithPagination($column = 'created_at',$order = 'DESC',$paginate = 10);
    public function ReadUserWithPagination($column = 'created_at',$order = 'DESC',$paginate = 10);

    

}
