<?php

namespace App\Http\Controllers;
use App\Http\Services\AdminService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    protected $adminService;
    public function __construct(AdminService $adminService)
    {
        $this->adminService=$adminService;
    }
    public function AuthLogin(){
        $admin_id=Session::get('admin_id');
        if ($admin_id){
            return \redirect()->route('admin.dashboard');
        }else{
            return \redirect()->route('admin.login');
        }
    }
    public function showFormLogin(){
        return view('admin_login');
    }
    public function login(Request $request){
        $admin_name=$request->admin_name;
        $admin_password=md5($request->admin_password);
        $login=$this->adminService->login($admin_name,$admin_password);
        if($login){
            $login_count = $login->count();
            if($login_count>0){
                Session::put('admin_name',$login->admin_name);
                Session::put('admin_id',$login->admin_id);
                return redirect()->route('admin.dashboard');
            }
        }else{
            Session::put('message','Tài khoản hoặc mật khẩu không đúng!');
            return Redirect::to('/admin');
        }
    }

    public function dashboard(){
        $this->AuthLogin();
        return view('admin.dashboard');
    }
    public function logout(){
        $this->AuthLogin();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return redirect()->route('login.admin');

    }
}
