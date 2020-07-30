<?php
namespace App\Repositories\Contracts;

interface UserRepositoryInterface  {

    public function getAuthUser();
    public function isAuthUserEqualTo($user);

    public function getAllUserCount();
    public function getAdminCount();
    public function getUserCount();

    public function getCardCountAndRoute();


    public function defaultReadWithPagination($column = 'created_at',$order = 'DESC',$paginate = 10);

    public function ReadAdminWithPagination($column = 'created_at',$order = 'DESC',$paginate = 10);
    public function ReadUserWithPagination($column = 'created_at',$order = 'DESC',$paginate = 10);



}
