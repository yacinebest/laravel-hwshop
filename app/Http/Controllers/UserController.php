<?php
namespace App\Http\Controllers;

use App\Http\Requests\User\UserUpdateRole;
use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    // public function index($name,User $model)
    public function index()
    {
        $page='All User';
        $users = $this->userRepository->defaultReadWithPagination();
        return $this->accessIndex($users,$page);
    }


    public function indexAdmin()
    {
        $page='Admin';
        $users = $this->userRepository->ReadAdminWithPagination();
        return $this->accessIndex($users,$page);
    }

    public function indexUser()
    {
        $page='User';
        $users = $this->userRepository->ReadUserWithPagination();
        return $this->accessIndex($users,$page);
    }

    public function accessIndex($users,$page)
    {
        $auth = $this->userRepository->getAuthUser();
        $columns = $this->userRepository->getAccessibleColumn();
        $cardCountAndRoute = $this->userRepository->getCardCountAndRoute();

        return view('users.index',compact('cardCountAndRoute','page','columns','users','auth') );
    }   




    public function edit($id)
    {
        $user = $this->userRepository->findOrFail($id);
        
        $closure  = function(RoleRepositoryInterface $rep){
            return $rep->all();
        };  
        $roles = app()->call($closure);
        return view('users.edit',compact('user','roles'));
    }

    public function update($id,UserUpdateRole $request)
    {
        $user = $this->userRepository->findOrFail($id);
        $this->userRepository->update($user,['role_id'=>$request->role_id]);
        return back()->withStatus(__('Profile successfully updated.'));
    }

    public function destroy($id)
    {
        $user = $this->userRepository->findOrFail($id);
        $this->userRepository->delete($user);
        return redirect()->back();
    }

}
