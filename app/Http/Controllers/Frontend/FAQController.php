<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    
    public function faq()
    {
        return view('frontend.faq.faq');
    }
}
