<?php


namespace App\Http\Services;
use App\Http\Repositories\CategoryRepository;

class CategoryService
{
    protected $categoryRepo;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepo=$categoryRepository;
    }
    public function addCategory($data){
        $this->categoryRepo->addCategoryProduct($data);
    }
    public function showListProduct(){
        return $this->categoryRepo->showListProduct();
    }
    public function active($id){
        $this->categoryRepo->active($id);
    }
    public function unactive($id){
        $this->categoryRepo->unactive($id);
    }
    public function findProductbyId($id){
        return $this->categoryRepo->findCategoryProductbyId($id);
    }
    public function updateCategoryProductbyId($id,$name,$slug,$desc,$keyword){
        $this->categoryRepo->updateCategoryProductbyId($id,$name,$slug,$desc,$keyword);
    }

}
