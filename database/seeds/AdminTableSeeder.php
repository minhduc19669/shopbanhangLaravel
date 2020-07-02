<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_admin')->insert([
            'admin_name'=>'minhphong',
            'admin_email'=>'minhphong@gmail.com',
            'admin_phone'=>'0982047922',
            'admin_password'=>md5(123456)
        ]);
    }
}
