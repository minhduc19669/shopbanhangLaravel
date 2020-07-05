<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    //
//    public function product(){
//        return $this->hasMany('App\Product','category_id');
//    }
    protected $table='tbl_category_product';

    protected $fillable=[
        'meta_keywords','category_name','slug_category_product','category_desc','category_status'
    ];
    protected $primaryKey='product_id';
}
