<?php

namespace App\Http\Controllers;

use App\BrandProduct;
use Illuminate\Http\Request;
use App\Product;
use App\CategoryProduct;
class HomeController extends Controller
{
    //

    public function index(){
        $products=Product::where('product_status',0)->orderBy('product_id','desc')->take(3)->get();
        return view('pages.home',['products'=>$products]);
    }
}
