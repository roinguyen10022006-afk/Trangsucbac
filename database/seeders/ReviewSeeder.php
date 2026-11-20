<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\Product;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();

        if ($products->isEmpty()) {
            $this->command->info('Chưa có sản phẩm nào để nạp đánh giá!');
            return;
        }

        // Danh sách tên khách hàng mẫu
        $names = [
            'Nguyễn Thảo Nhi', 'Trần Minh Anh', 'Lê Khánh Linh', 
            'Phạm Hoàng Nam', 'Vũ Quỳnh Trang', 'Bùi Mỹ Duyên', 
            'Đỗ Đức Trọng', 'Hoàng Bảo Ngọc', 'Đặng Kim Anh', 'Nguyễn Phương Thảo'
        ];

        // Danh sách câu nhận xét chân thực về trang sức bạc S925
        $comments = [
            'Sản phẩm bạc S925 rất sáng bóng, đeo lên tay nhìn cực kỳ sang trọng!',
            'Đóng gói hộp quà siêu chỉn chu, giao hàng nhanh hơn mong đợi.',
            'Trang sức mảnh mai, mặt đá đính rất chắc chắn và lấp lánh dưới ánh sáng.',
            'Đeo vừa vặn, chất lượng bạc chuẩn không bị ngứa hay dị ứng da.',
            'Mua làm quà tặng bạn gái, bạn mình khen nức nở luôn. 10/10!',
            'Shop tư vấn nhiệt tình, đóng gói hàng đẹp mắt và có phiếu bảo hành.',
            'Giá cả quá hợp lý cho dòng sản phẩm trang sức bạc cao cấp này.',
        ];

        // Mỗi sản phẩm sẽ được tạo ngẫu nhiên từ 2 đến 4 đánh giá
        foreach ($products as $product) {
            $reviewCount = rand(2, 4);

            for ($i = 0; $i < $reviewCount; $i++) {
                Review::create([
                    'product_id' => $product->id,
                    'user_name'  => $names[array_rand($names)],
                    'rating'     => rand(4, 5), // Ngẫu nhiên 4 hoặc 5 sao
                    'comment'    => $comments[array_rand($comments)],
                    'created_at' => now()->subDays(rand(1, 10)), // Tạo thời gian rải rác từ 1-10 ngày trước
                ]);
            }
        }
    }
}