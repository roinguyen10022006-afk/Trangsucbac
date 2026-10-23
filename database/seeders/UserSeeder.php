<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //// 1. Tài khoản Admin mẫu
        User::create([
            'role_id' => 1,
            'name' => 'Quản Trị Viên',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'phone' => '0901234567',
            'address' => 'Thành phố Hồ Chí Minh',
        ]);

        // 2. Tài khoản Khách hàng mẫu
        User::create([
            'role_id' => 2,
            'name' => 'Nguyễn Văn Khách',
            'email' => 'user@gmail.com',
            'password' => Hash::make('12345678'),
            'phone' => '0987654321',
            'address' => 'Hà Nội',
        ]);
    }
    
}
