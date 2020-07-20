<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $routes = [
        'Admin'=>'user.admin.index',
        'User'=>'user.user.index',
        'All User'=> 'user.index'
    ];

    protected $columns =[
        'avatar'=>'Avatar',
        // 'username'=>'Username',
        'roleType'=>'Role',
        'firstname'=>'First Name',
        'lastname'=>'Last Name',
        'email'=>'Email',
        'phone_number'=>'Phone Number',
        'created_at' => 'Created At'
    ];

    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    // public function index($name,User $model)
    public function index()
    {

        $auth = Auth::user();
        $routes = $this->routes;
        $columns = $this->columns;
        $models = $this->getModelsCount();

        $page='All User';
        $users = User::orderBy('created_at','DESC')->paginate(10);


        return view('users.index',compact('page','routes','models','columns','users','auth') );
    }


    public function indexAdmin()
    {
        $auth = Auth::user();
        $routes = $this->routes;
        $columns = $this->columns;
        $models = $this->getModelsCount();

        $page='Admin';
        $users = User::where('role_id',Role::whereType('ADMIN')->first()->id )
                            ->orderBy('created_at','DESC')->paginate(10);


        return view('users.index',compact('page','routes','models','columns','users','auth') );
    }

    public function indexUser()
    {
        $auth = Auth::user();
        $routes = $this->routes;
        $columns = $this->columns;
        $models = $this->getModelsCount();

        $page='User';
        $users = User::where('role_id',Role::whereType('USER')->first()->id )
                            ->orderBy('created_at','DESC')->paginate(10);


        return view('users.index',compact('page','routes','models','columns','users','auth') );
    }

    public function edit($id)
    {
        // dd($id);
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('users.edit',compact('user','roles'));
    }

    public function updateRole($id,Request $request)
    {
        $user = User::findOrFail($id);
        $user->update(['role_id'=>$request->role_id]);
        return back()->withStatus(__('Profile successfully updated.'));
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back();
    }


/*
|---------------------------------------------------------------------------|
| CUSTOM FUNCTION                                                           |
|---------------------------------------------------------------------------|
*/
    public function getModelsCount()
    {
        return $models = [
            'Admin'=>User::countAdmin(),
            'User'=>User::countUser(),
            'All User' => User::count(),
        ];
    }
}
