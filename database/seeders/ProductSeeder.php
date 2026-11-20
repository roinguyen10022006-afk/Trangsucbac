<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Xóa dữ liệu cũ trong bảng products trước khi seed
        DB::table('products')->delete();

        $products = [
            // Nhẫn Bạc
            [
                'category_id' => 1,
                'name' => 'Nhẫn Bạc Ý Đính Đá Kim Sa S925',
                'slug' => Str::slug('Nhẫn Bạc Ý Đính Đá Kim Sa S925'),
                'price' => 450000,
                'stock_quantity' => 25,
                'purity' => 'Bạc S925',
                'description' => 'Nhẫn bạc Ý cao cấp phủ bạch kim đính đá CZ lấp lánh, phong cách nữ tính và sang trọng.',
                'image' => 'products/nhan_01.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'name' => 'Nhẫn Bạc Trơn Minimalist S925',
                'slug' => Str::slug('Nhẫn Bạc Trơn Minimalist S925'),
                'price' => 280000,
                'stock_quantity' => 30,
                'purity' => 'Bạc S925',
                'description' => 'Thiết kế trơn phong cách tối giản, dễ kết hợp phối đồ hàng ngày.',
                'image' => 'products/nhan_02.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'name' => 'Nhẫn Bạc Nữ Hình Vương Miện Quyến Rũ',
                'slug' => Str::slug('Nhẫn Bạc Nữ Hình Vương Miện Quyến Rũ'),
                'price' => 520000,
                'stock_quantity' => 15,
                'purity' => 'Bạc S925',
                'description' => 'Kiểu dáng vương miện đính đá tinh xảo tôn vinh nét quyến rũ kiêu sa.',
                'image' => 'products/nhan_03.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Dây Chuyền Bạc
            [
                'category_id' => 2,
                'name' => 'Dây Chuyền Bạc Cỏ 4 Lá May Mắn',
                'slug' => Str::slug('Dây Chuyền Bạc Cỏ 4 Lá May Mắn'),
                'price' => 680000,
                'stock_quantity' => 20,
                'purity' => 'Bạc S925',
                'description' => 'Mặt dây chuyền hình cỏ 4 lá may mắn đính đá xanh ngọc bảo an lành.',
                'image' => 'products/daychuyen_01.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Dây Chuyền Bạc Khóa Trái Tim Lấp Lánh',
                'slug' => Str::slug('Dây Chuyền Bạc Khóa Trái Tim Lấp Lánh'),
                'price' => 590000,
                'stock_quantity' => 18,
                'purity' => 'Bạc 925',
                'description' => 'Mặt khóa trái tim biểu tượng của tình yêu vĩnh cửu và lãng mạn.',
                'image' => 'products/daychuyen_02.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Dây Chuyền Bạc Ý Giọt Nước Nguyện Ước',
                'slug' => Str::slug('Dây Chuyền Bạc Ý Giọt Nước Nguyện Ước'),
                'price' => 720000,
                'stock_quantity' => 12,
                'purity' => 'Bạc S990',
                'description' => 'Mặt đá sapphire xanh hình giọt nước tạo điểm nhấn thanh tú trên cổ.',
                'image' => 'products/daychuyen_03.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Bông Tai Bạc
            [
                'category_id' => 3,
                'name' => 'Bông Tai Bạc Nụ Ngọc Trai Tự Nhiên',
                'slug' => Str::slug('Bông Tai Bạc Nụ Ngọc Trai Tự Nhiên'),
                'price' => 450000,
                'stock_quantity' => 22,
                'purity' => 'Bạc S925',
                'description' => 'Khuyên nụ bạc đính ngọc trai nước ngọt dịu dàng, quý phái.',
                'image' => 'products/bongtai_01.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'name' => 'Bông Tai Bạc Tua Rua Hoa Tuyết',
                'slug' => Str::slug('Bông Tai Bạc Tua Rua Hoa Tuyết'),
                'price' => 380000,
                'stock_quantity' => 16,
                'purity' => 'Bạc 925',
                'description' => 'Bông tai dáng dài tua rua hoa tuyết lấp lánh bắt sáng cực đẹp.',
                'image' => 'products/bongtai_02.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'name' => 'Khuyên Tai Bạc Tròn Bản Ôm CZ',
                'slug' => Str::slug('Khuyên Tai Bạc Tròn Bản Ôm CZ'),
                'price' => 320000,
                'stock_quantity' => 40,
                'purity' => 'Bạc S925',
                'description' => 'Khuyên tai khoen tròn đính đá zircon ôm sát vành tai cá tính.',
                'image' => 'products/bongtai_03.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Vòng Tay / Lắc Tay Bạc
            [
                'category_id' => 4,
                'name' => 'Lắc Tay Bạc Ý Khóa Trái Tim Thanh Lịch',
                'slug' => Str::slug('Lắc Tay Bạc Ý Khóa Trái Tim Thanh Lịch'),
                'price' => 550000,
                'stock_quantity' => 15,
                'purity' => 'Bạc S925',
                'description' => 'Lắc tay dây mềm phối chốt khóa trái tim mạ rhodium bóng bền màu.',
                'image' => 'products/lactay_01.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 4,
                'name' => 'Vòng Tay Bạc Cứng Bản Trơn Sang Trọng',
                'slug' => Str::slug('Vòng Tay Bạc Cứng Bản Trơn Sang Trọng'),
                'price' => 790000,
                'stock_quantity' => 10,
                'purity' => 'Bạc S990',
                'description' => 'Vòng kiềng bạc cứng thiết kế tối giản dành cho quý cô thời thượng.',
                'image' => 'products/lactay_02.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 4,
                'name' => 'Lắc Tay Bạc Bi Tròn Phối Charm Cỏ 4 Lá',
                'slug' => Str::slug('Lắc Tay Bạc Bi Tròn Phối Charm Cỏ 4 Lá'),
                'price' => 620000,
                'stock_quantity' => 14,
                'purity' => 'Bạc S925',
                'description' => 'Chuỗi bi bạc đan xen các hạt charm nhỏ mang lại may mắn và bình an.',
                'image' => 'products/lactay_03.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('products')->insert($products);
    }
}