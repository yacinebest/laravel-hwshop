<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PasswordRequest;
use App\Repositories\Contracts\ImageRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository,
                                ImageRepositoryInterface $imageRepository) {
        $this->userRepository = $userRepository;
        $this->imageRepository = $imageRepository;
    }


    public function profile(){
        $user = $this->userRepository->getAuthUser();
        $editable_columns = $this->userRepository->getEditableColumn();
        return view('frontend.users.profile',compact('user','editable_columns'));
    }

    public function orders(){
        $user = $this->userRepository->getAuthUser();
        $orders = $this->userRepository->getOrdersSortByDate($user);
        return view('frontend.users.orders',compact('user','orders'));
    }

    public function histories(){
        $user = $this->userRepository->getAuthUser();
        return view('frontend.users.histories',compact('user'));
    }

    public function comments(){
        $user = $this->userRepository->getAuthUser();
        return view('frontend.users.comments',compact('user'));
    }


    public function updateProfile(Request $request)
    {
        $user = $this->userRepository->getAuthUser();
        $this->userRepository->update($user,$request->all());
        return back()->withStatus(__('Profile successfully updated.'));
    }

    public function uploadAvatar(Request $request)
    {
        $avatar = $this->imageRepository->storeFile($request->file('avatar'),"public/uploads/avatars");
        $user = $this->userRepository->baseFindOrFail($request->user_id);
        $this->userRepository->update($user,['avatar' => $avatar ]);
        return response()->json($avatar);
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
}
