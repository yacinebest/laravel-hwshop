<?php
namespace App\Repositories;

use App\Models\Role;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class UserRepository extends BaseRepository implements UserRepositoryInterface  {

/*
|---------------------------------------------------------------------------|
| Override BaseRepository FUNCTION                                          |
|---------------------------------------------------------------------------|
*/
    public function getAccessibleColumn(){
        return [
            'avatar'=>'Avatar',
            'username'=>'Username',
            'roleType'=>'Role',
            'firstname'=>'First Name',
            'lastname'=>'Last Name',
            'email'=>'Email',
            'phone_number'=>'Phone Number',
            // 'created_at' => 'Created At'
        ];
    }

    public function getCardCountAndRoute(){
        return [
            'Admin'=>['count'=>$this->countOnlyAdmin(),'route'=>'user.admin.index'],
            'User'=>['count'=>$this->countOnlyUser(),'route'=>'user.user.index'],
            'All User'=>['count'=>$this->baseCount(),'route'=>'user.index'],
        ];
    }
/*
|---------------------------------------------------------------------------|
| Override Interface FUNCTION                                               |
|---------------------------------------------------------------------------|
*/
    public function getAuthUser(){
        return Auth::check() ? User::findOrFail(Auth::user()->id ) : null ;
    }

    public function isAuthEqualTo($user){
        return $this->getAuthUser() && ($this->getAuthUser()->id === $user->id) ;
    }

    public function countOnlyUser(){
        return User::countUser();
    }

    public function countOnlyAdmin(){
        return User::countAdmin();
    }

    public function paginateOnlyAdmin($column = 'created_at',$order = 'DESC',$paginate = 10){
        return User::where('role_id',Role::whereType('ADMIN')->first()->id )
                            ->orderBy($column,$order)->paginate($paginate);;
    }

    public function paginateOnlyUser($column = 'created_at',$order = 'DESC',$paginate = 10){
        return User::where('role_id',Role::whereType('USER')->first()->id )
                            ->orderBy($column,$order)->paginate($paginate);;
    }

    public function getReadOnlyColumn(){
        return [
            'username'=>'Username',
            'firstname'=>'First name',
            'lastname'=>'Last name',
            'email'=>'Email',
            'birth_date'=>'Birth Date',
            'country'=>'Country',
            'address'=>'Address',
            'phone_number'=>'Phone Number',
            'gender'=>'Gender'
        ];
    }

    public function getEditableColumn(){
        return  [
            'username'=>'Username',
            'firstname'=>'First name',
            'lastname'=>'Last name',
            'email'=>'Email',
            'phone_number'=>'Phone Number',
            'birth_date'=>'Birth Date',
            'country'=>'Country',
            'address'=>'Address',
        ];
    }
}
