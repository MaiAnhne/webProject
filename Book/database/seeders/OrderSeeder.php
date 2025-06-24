<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Book;
use App\Models\User;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $user = User::first(); // Lấy user đầu tiên (hoặc tạo mới)

        if (!$user) {
            $user = User::factory()->create();
        }

        $books = Book::all();

        // Tạo 3 Order mẫu
        for ($i = 0; $i < 3; $i++) {
            $order = Order::create([
                'user_id' => $user->id,
                'total' => 0,
            ]);

            $orderTotal = 0;

            // Mỗi order có từ 2-3 sách
            foreach ($books->random(rand(2, 3)) as $book) {
                $quantity = rand(1, 3);
                $price = $book->price;

                OrderItem::create([
                    'order_id' => $order->id,
                    'book_id' => $book->id,
                    'quantity' => $quantity,
                    'price' => $price,
                ]);

                $orderTotal += $quantity * $price;
            }

            $order->update(['total' => $orderTotal]);
        }
    }
}
