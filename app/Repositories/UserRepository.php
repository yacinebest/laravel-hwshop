<?php
namespace App\Repositories;

use App\Models\Role;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Traits\Base\DeleteTrait;
use App\Traits\Base\ReadTrait;
use App\Traits\Base\UpdateTrait;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface  {

    use DeleteTrait;
    use ReadTrait{
        findOrFail as baseFindOrFail;
    }
    use UpdateTrait;

    public function getAuthUser(){
        return Auth::user();
    }


    

    public function getAllUserCount(){
        return User::count();
    }

    public function getAdminCount(){
        return User::countAdmin();
    }

    public function getUserCount(){
        return User::countUser();
    }




    public function getAccessibleColumn(){
        return [
            'avatar'=>'Avatar',
            'username'=>'Username',
            'roleType'=>'Role',
            'firstname'=>'First Name',
            'lastname'=>'Last Name',
            'email'=>'Email',
            'phone_number'=>'Phone Number',
            'created_at' => 'Created At'
        ];
    }

    public function getCardCountAndRoute(){
        return [
            'Admin'=>['count'=>$this->getAdminCount(),'route'=>'user.admin.index'],
            'User'=>['count'=>$this->getUserCount(),'route'=>'user.user.index'],
            'All User'=>['count'=>$this->getAllUserCount(),'route'=>'user.index'],
        ];
    }

    public function defaultReadWithPagination($column = 'created_at',$order = 'DESC',$paginate = 10){
        return User::orderBy($column,$order)->paginate($paginate);;
    }

    public function ReadAdminWithPagination($column = 'created_at',$order = 'DESC',$paginate = 10){
        return User::where('role_id',Role::whereType('ADMIN')->first()->id )
                            ->orderBy($column,$order)->paginate($paginate);;
    }

    public function ReadUserWithPagination($column = 'created_at',$order = 'DESC',$paginate = 10){
        return User::where('role_id',Role::whereType('USER')->first()->id )
                            ->orderBy($column,$order)->paginate($paginate);;
    }


    
    public function findOrFail($id,$model = null){
        return $this->baseFindOrFail($id,'User');
    }

}
