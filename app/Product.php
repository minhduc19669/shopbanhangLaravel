<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='tbl_product';
    protected $fillable=[
        'product_id','product_name','product_quantity','product_sold','product_slug','category_id','brand_id','product_desc','product_content',
        'product_price','product_image','product_status'
    ];
    protected $primaryKey='product_id';


    //
}
