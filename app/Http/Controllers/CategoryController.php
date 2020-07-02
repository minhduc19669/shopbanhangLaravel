<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CategoryService;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    //
    protected $categoryServive;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryServive=$categoryService;
    }

    public function show_form_add_category_product(){
        return view('admin.add_category_product');
    }
    public function show_list_category_product(){
        $products=$this->categoryServive->showListProduct();
        return view('admin.all_category_product',compact('products'));
    }
    public function add_category_product(Request $request){
        $category_product_name=$request->category_product_name;
        $slug_category_product=$request->slug_category_product;
        $category_product_desc=$request->category_product_desc;
        $category_product_keywords=$request->category_product_keywords;
        $category_product_status=$request->category_product_status;
        $data=[
            'category_name'=>$category_product_name,
            'slug_category_product'=>$slug_category_product,
            'category_desc'=>$category_product_desc,
            'meta_keywords'=>$category_product_keywords,
            'category_status'=>$category_product_status
        ];
        $this->categoryServive->addCategory($data);
        Session::put('message','Thêm danh mục thành công');
        return redirect()->route('admin.show-list-category');
    }
    public function activeStatusProduct($id){
        $this->categoryServive->active($id);
        Session::put('message','Active Success');
        return back();
    }
    public function unactiveStatusProduct($id){
        $this->categoryServive->unactive($id);
        Session::put('message','UnActive Success');
        return back();
    }


}
