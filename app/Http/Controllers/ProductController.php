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
        $products =
            Product::join('tbl_category_product','tbl_category_product.category_id', '=', 'tbl_product.category_id')
                ->join('tbl_brand','tbl_brand.brand_id', '=', 'tbl_product.brand_id')
                ->orderBy('product_id','desc')
                ->paginate(5);
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

}
