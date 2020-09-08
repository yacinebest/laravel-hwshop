<?php
namespace App\Http\Controllers;

use App\Http\Requests\User\PasswordRequest;
use App\Http\Requests\User\ProfileRequest;
use App\Http\Requests\User\UserUpdateRole;
use App\Repositories\Contracts\ImageRepositoryInterface;
use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepository;
    private $imageRepository;
    private $roleRepository;

    public function __construct(UserRepositoryInterface $userRepository,
                                ImageRepositoryInterface $imageRepository,
                                RoleRepositoryInterface $roleRepository) {
        $this->userRepository = $userRepository;
        $this->imageRepository = $imageRepository;
        $this->roleRepository = $roleRepository;
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

        return view('backend.users.index',compact('cardCountAndRoute','page','columns','users','auth') );
    }




    public function edit($id)
    {

        $user = $this->userRepository->baseFindOrFail($id);
        if($this->userRepository->isAuthEqualTo($user) )
            return redirect()->route('user.profile');
        else{
            $roles = $this->roleRepository->baseAll() ;
            $read_only_columns = $this->userRepository->getReadOnlyColumn();

            return view('backend.users.edit',compact('user','roles','read_only_columns'));
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
        $roles = $this->roleRepository->baseAll() ;
        $editable_columns = $this->userRepository->getEditableColumn();

        return view('backend.users.profile',compact('user','roles','editable_columns'));
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
        $avatar = $this->imageRepository->storeFile($request->file('avatar'),"public/uploads/avatars");
        $user = $this->userRepository->baseFindOrFail($request->user_id);
        $this->userRepository->update($user,['avatar' => $avatar ]);
        return response()->json($avatar);
    }

}
