<?php
namespace App\Http\Controllers;


use App\Http\Requests\UserRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('users.edit',compact('user','roles'));
    }

    public function updateRole($id,Request $request)
    {
        $user = User::findOrFail($id);
        $user->update(['role_id'=>$request->role_id]);
        $user->refresh();
        return back()->withStatus(__('Profile successfully updated.'));
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back();
    }

}
