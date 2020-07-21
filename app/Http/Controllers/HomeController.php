<?php

namespace App\Http\Controllers;

use App\Models\BaseModel;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class HomeController extends Controller
{

    private $userRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $cardCountAndRoute =[
            'User'=>['count'=>$this->userRepository->getAllUserCount(),'route'=>'user.index'],
            'Product'=>['count'=>count(Product::all()),'route'=>'user.index'],
            'Category'=>['count'=>count(Category::all()),'route'=>'user.index'],
            'Order'=>['count'=>count(Order::all()),'route'=>'user.index'],
        ];

        return view('dashboard',compact('cardCountAndRoute'));
    }
}
