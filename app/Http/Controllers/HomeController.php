<?php

namespace App\Http\Controllers;

use App\Models\BaseModel;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        $models = [
            'User'=>User::count(),
            'Product'=>count(Product::all()),
            'Category'=>count(Category::all()),
            'Order'=>count(Order::all()),
        ];

        $routes = [
            'User'=>'user.index',
            'Product'=>'user.index',
            'Category'=> 'user.index',
            'Order'=>'user.index'
        ];

        return view('dashboard',compact('models','routes'));
    }
}
