<?php


namespace App\Http\Services;
use App\Http\Repositories\CategoryRepository;

class CategoryService
{
    protected $categoryService;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryService=$categoryRepository;
    }
    public function addCategory($data){
        $this->categoryService->addCategoryProduct($data);
    }
    public function showListProduct(){
        return $this->categoryService->showListProduct();
    }
    public function active($id){
        $this->categoryService->active($id);
    }
    public function unactive($id){
        $this->categoryService->unactive($id);
    }

}
