<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\BrandProduct;
use App\CategoryProduct;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{

    public function index()
    {
//        $products=Product::find(1);
//        dd($products->category->category_name);
        $products =
            Product::join('tbl_category_product','tbl_category_product.category_id', '=', 'tbl_product.category_id')
                ->join('tbl_brand','tbl_brand.brand_id', '=', 'tbl_product.brand_id')
                ->orderBy('product_id','desc')
                ->paginate(4);
        return view('admin.all_product', compact('products'));
    }


    public function addProduct()
    {
        $cate_product = CategoryProduct::orderBy('category_id', 'desc')->get();
        $brand_product = BrandProduct::orderBy('brand_id', 'desc')->get();
        return view('admin.add_product', compact('cate_product', 'brand_product'));
    }

    public function createproduct(Request $request)
    {
        if ($request->hasFile('product_image')) {
            try {
                $this->validate($request, ['product_image' => 'mimes:jpg,jpeg,png,gif|max:2048'], ['product_image.mimes' => 'Chỉ chấp nhận hình với đuôi .jpg .jpeg .png .gif',
                    'product.max' => 'Hình giới hạn dung lượng không quá 2M',
                ]);
                $image = $request->file('product_image');
                $get_image = time() . '_' . $image->getClientOriginalName();
                $location = public_path('uploads/product');
                $image->move($location, $get_image);
                Product::create([
                    'product_name' => $request->product_name,
                    'product_quantity' => $request->product_quantity,
                    'product_slug' => $request->product_slug,
                    'category_id' => $request->product_cate,
                    'brand_id' => $request->product_brand,
                    'product_price' => $request->product_price,
                    'product_desc' => $request->product_desc,
                    'product_content' => $request->product_content,
                    'product_image' => $get_image,
                    'product_sold' => 1,
                    'product_status' => $request->product_status
                ]);
                Session::put('message', 'Thêm thành công!');
            } catch (ValidationException $e) {
                $message = 'Error:' . $e->getMessage();
                Session::put('message', $message);

            }
        } else {
            $get_image = '';
            Product::create([
                'product_name' => $request->product_name,
                'product_quantity' => $request->product_quantity,
                'product_slug' => $request->product_slug,
                'category_id' => $request->product_cate,
                'product_price' => $request->product_price,
                'brand_id' => $request->product_brand,
                'product_desc' => $request->product_desc,
                'product_content' => $request->product_content,
                'product_image' => $get_image,
                'product_sold' => 1,
                'product_status' => $request->product_status
            ]);
            Session::put('message', 'Sucesss!');
        }
        return back();
    }

    public function editproduct($id)
    {
        $cate_product=CategoryProduct::all();
        $brand_product=BrandProduct::all();
        $products = Product::where('product_id',$id)->get();
        return view('admin.edit_product', compact('products','cate_product','brand_product'));
    }
    public function storeproduct(Request $request,$id){
            if ($request->hasFile('product_image')) {
                try {
                    $this->validate($request, ['product_image' => 'mimes:jpg,jpeg,png,gif|max:2048'], ['product_image.mimes' => 'Chỉ chấp nhận hình với đuôi .jpg .jpeg .png .gif',
                        'product.max' => 'Hình giới hạn dung lượng không quá 2M',
                    ]);
                    $image = $request->file('product_image');
                    $get_image = time() . '_' . $image->getClientOriginalName();
                    $location = public_path('uploads/product');
                    $image->move($location, $get_image);
                    Product::where('product_id',$id)->update([
                        'product_name' => $request->product_name,
                        'product_quantity' => $request->product_quantity,
                        'product_slug' => $request->product_slug,
                        'category_id' => $request->product_cate,
                        'brand_id' => $request->product_brand,
                        'product_price' => $request->product_price,
                        'product_desc' => $request->product_desc,
                        'product_content' => $request->product_content,
                        'product_image' => $get_image,
                        'product_sold' => 1,
                        'product_status' => $request->product_status
                    ]);
                    Session::put('message', 'Cập nhập thành công!');
                } catch (ValidationException $e) {
                    $message = 'Error:' . $e->getMessage();
                    Session::put('message', $message);

                }
            } else {
                Product::where('product_id',$id)->update([
                    'product_name' => $request->product_name,
                    'product_quantity' => $request->product_quantity,
                    'product_slug' => $request->product_slug,
                    'category_id' => $request->product_cate,
                    'product_price' => $request->product_price,
                    'brand_id' => $request->product_brand,
                    'product_desc' => $request->product_desc,
                    'product_content' => $request->product_content,
                    'product_sold' => 1,
                    'product_status' => $request->product_status
                ]);
                Session::put('message','Cập nhập thành công!');
            }
            return back();
    }

    public function deleteproduct($id)
    {
        Product::where('product_id', $id)->delete();
        Session::put('message', 'Delete Sucsess!');
        return redirect()->route('admin.list_product');
    }
    public function active($id){
        Product::where('product_id',$id)->update(['product_status'=>0]);
        Session::put('message', 'Active Sucsess!');
        return back();
    }
    public function unactive($id){
        Product::where('product_id',$id)->update(['product_status'=>1]);
        Session::put('message', 'un Active Sucsess!');
        return back();
    }
    public function show_category_product($id){
        $products = Product::join('tbl_category_product','tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->where('tbl_product.category_id',$id)
            ->orderBy('product_id','desc')
            ->get();
        $desc_name=CategoryProduct::where('category_id',$id)->take(1)->get();
        return view('pages.category_product',compact('products','desc_name'));
    }
    public function show_brand_product($id){
        $products = Product::join('tbl_brand','tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->where('tbl_product.brand_id',$id)
            ->orderBy('product_id','desc')
            ->get();
        $brand_name=BrandProduct::where('brand_id',$id)->take(1)->get();
        return view('pages.brand_product',compact('products','brand_name'));
    }

    public function show_detail_product($id){
        $products = Product::join('tbl_category_product','tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand','tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->where('product_id',$id)
            ->orderBy('product_id','desc')
            ->get();
        foreach ($products as $value){
            $orther_id=$value->category_id;
        }
        $ortherProducts=Product::join('tbl_category_product','tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand','tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->where('tbl_category_product.category_id',$orther_id)->whereNotIn('tbl_product.product_id',[$id])
            ->get();
        return view('pages.detail_product',compact('products','ortherProducts'));
    }

}
