<?php


namespace App\Http\Repositories;
use App\CategoryProduct;

class CategoryRepository
{
    protected $categoryProduct;
    public function __construct(CategoryProduct $categoryProduct)
    {
        $this->categoryProduct=$categoryProduct;
    }
    public function addCategoryProduct($data){
        $this->categoryProduct->create($data);
    }
    public function showListProduct(){
        return $this->categoryProduct->all();
    }
    public function active($id){
        $this->categoryProduct->where('category_id',$id)->update(['category_status'=>0]);
    }
    public function unactive($id){
        $this->categoryProduct->where('category_id',$id)->update(['category_status'=>1]);
    }
    public function findCategoryProductbyId($id){
        return $this->categoryProduct->where('category_id',$id)->get();
    }
    public function updateCategoryProductbyId($id,$name,$slug,$desc,$keyword){
        $this->categoryProduct->where('category_id',$id)->update([
            'category_name'=>$name,
            'slug_category_product'=>$slug,
            'category_desc'=>$desc,
            'meta_keywords'=>$keyword
        ]);
    }

}
