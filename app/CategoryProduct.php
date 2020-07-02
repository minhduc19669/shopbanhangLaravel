<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    //
    protected $table='tbl_category_product';

    protected $fillable=[
        'meta_keywords','category_name','slug_category_product','category_desc','category_status'
    ];
}
