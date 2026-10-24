<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'category_id' => 1,
            'name' => 'Nhẫn Bạc Ý Đính Đá Kim Sa',
            'slug' => 'nhan-bac-y-dinh-da-kim-sa',
            'price' => 450000,
            'stock_quantity' => 20,
            'purity' => 'Bạc S925',
            'description' => 'Nhẫn bạc Ý cao cấp đính đá cz lấp lánh.',
            'image' => null
        ]);

        Product::create([
            'category_id' => 2,
            'name' => 'Dây Chuyền Bạc Cỏ 4 Lá',
            'slug' => 'day-chuyen-bac-co-4-la',
            'price' => 680000,
            'stock_quantity' => 15,
            'purity' => 'Bạc 925',
            'description' => 'Dây chuyền bạc cỏ 4 lá may mắn.',
            'image' => null
        ]);
    }
}
