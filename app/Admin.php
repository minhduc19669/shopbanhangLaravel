<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table='tbl_admin';
    protected $fillable = [
        'admin_name', 'admin_email', 'admin_password','admin_id'
    ];
    protected $primaryKey = 'admin_id';


    //
}

