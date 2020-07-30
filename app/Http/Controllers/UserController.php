<?php
namespace App\Http\Controllers;

use App\Http\Requests\User\PasswordRequest;
use App\Http\Requests\User\ProfileRequest;
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
        $users = $this->userRepository->basePaginate();
        return $this->accessIndex($users,$page);
    }


    public function indexAdmin()
    {
        $page='Admin';
        $users = $this->userRepository->paginateOnlyAdmin();
        return $this->accessIndex($users,$page);
    }

    public function indexUser()
    {
        $page='User';
        $users = $this->userRepository->paginateOnlyUser();
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
        $user = $this->userRepository->baseFindOrFail($id);
        if($this->userRepository->isAuthEqualTo($user) )
            return redirect()->route('user.profile');
        else{
            $closure  = function(RoleRepositoryInterface $rep){
                return $rep->baseAll();
            };
            $roles = app()->call($closure);
            return view('users.edit',compact('user','roles'));
        }
    }

    public function update($id,UserUpdateRole $request)
    {
        $user = $this->userRepository->baseFindOrFail($id);
        $this->userRepository->update($user,['role_id'=>$request->role_id]);
        return back()->withStatus(__('Profile successfully updated.'));
    }

    public function updateProfile(ProfileRequest $request)
    {
        $user = $this->userRepository->getAuthUser();
        $this->userRepository->update($user,$request->all());
        return back()->withStatus(__('Profile successfully updated.'));
    }

    public function destroy($id)
    {
        $user = $this->userRepository->baseFindOrFail($id);
        $this->userRepository->delete($user);
        return redirect()->back();
    }


    public function profile()
    {

        $user = $this->userRepository->getAuthUser();
        $closure  = function(RoleRepositoryInterface $rep){
            return $rep->baseAll();
        };
        $roles = app()->call($closure);
        return view('users.profile',compact('user','roles'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\User\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        $user = $this->userRepository->getAuthUser();
        $this->userRepository->update($user,['password' => bcrypt($request->get('password')) ]);
        return back()->withPasswordStatus(__('Password successfully updated.'));
    }

    public function uploadAvatar(Request $request)
    {
        $avatar = $this->storeFile($request->file('avatar'),"public/uploads/avatars");
        $user = $this->userRepository->baseFindOrFail($request->user_id);
        $this->userRepository->update($user,['avatar' => $avatar ]);
        return response()->json($avatar);
    }

    private function storeFile($file , $path)
    {
        $file->store($path);
        return $file->hashName();
    }
}
