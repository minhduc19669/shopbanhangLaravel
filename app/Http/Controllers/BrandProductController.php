<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BrandProduct;
use Illuminate\Support\Facades\Session;

class BrandProductController extends Controller
{
    //

    public function index()
    {
        $brands = BrandProduct::all();
        return view('admin.all_brand_product',compact('brands'));

    }
    public function addBrandProduct(){
        return view('admin.add_brand_product');
    }
    public function store(Request $request){
        $brand_name=$request->brand_product_name;
        $brand_slug=$request->brand_slug;
        $brand_desc=$request->brand_desc;
        $brand_status=$request->brand_status;
        $brand=[
            'brand_name'=>$brand_name,
            'brand_slug'=>$brand_slug,
            'brand_desc'=>$brand_desc,
            'brand_status'=>$brand_status
        ];
        BrandProduct::create($brand);
        Session::put('message','Thêm thương hiệu mới thành công!');
        return redirect()->route('admin.list_brand');
    }
    public function unactiveBrandProduct($id){
        // dd($id);
        BrandProduct::where('brand_id',$id)->update(['brand_status'=>1]);
        Session::put('message','Active Sucsess!');
        return back();
    }
    public function activeBrandProduct($id){
        BrandProduct::where('brand_id',$id)->update(['brand_status'=>0]);
        Session::put('message','unActive Sucsess!');
        return back();
    }
    public function delete($id){
        BrandProduct::where('brand_id',$id)->delete();
        Session::put('message','Delete done!');
        return back();
    }
    public function editBrand($id){
        $brands_product=BrandProduct::where('brand_id',$id)->get();
        return view('admin.edit_brand_product',compact('brands_product'));
    }
    public function updateBrandProduct(Request $request,$id){

        BrandProduct::where('brand_id',$id)->update([
            'brand_name'=>$request->brand_product_name,
            'brand_slug'=>$request->brand_product_slug,
            'brand_desc'=>$request->brand_product_desc,
            'brand_status'=>$request->brand_product_status
        ]);
        Session::put('message','Cập nhập thương hiệu thành công!');
        return back();
    }
}
