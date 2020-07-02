<?php

namespace App\Http\Services;

use App\Http\Repositories\AdminRepository;

class AdminService
{
    protected $adminRepo;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepo = $adminRepository;
    }

    public function login($admin_name, $admin_password)
    {
        return $this->adminRepo->login($admin_name, $admin_password);
    }
}

