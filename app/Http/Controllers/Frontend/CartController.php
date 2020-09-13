<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function cart(){
        return view('frontend.carts.cart');
    }

    public function order(Request $request){
        dd($request->all());
        return [] ;
    }
}
