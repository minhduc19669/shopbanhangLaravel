<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BrandProduct extends Model
{
    //
    protected $table='tbl_brand';
    protected $fillable=[
        'brand_id','brand_name','brand_slug','brand_desc','brand_status','created_at','updated_at'
    ];
    protected $primaryKey='brand_id';
}
