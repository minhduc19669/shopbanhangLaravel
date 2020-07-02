<?php
namespace App\Http\Repositories;
use App\Admin;
use Illuminate\Support\Facades\Hash;

class AdminRepository {

    protected $admin;
    public function __construct(Admin $admin)
    {
        $this->admin=$admin;
    }
    public function login($admin_name,$admin_password){
//        $pass=md5($admin_password);
        return $this->admin->where("admin_name",$admin_name)->where('admin_password',$admin_password)->first();
    }
}

