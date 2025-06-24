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
        $user = User::first();
        if (!$user) {
            $user = User::factory()->create();
        }

        $books = Book::all();

        if ($books->count() < 2) {
            $this->command->error('Cần ít nhất 2 Book trong database để tạo Order!');
            return;
        }

        for ($i = 0; $i < 3; $i++) {
            $order = Order::create([
                'user_id' => $user->id,
                'total' => 0,
            ]);

            $orderTotal = 0;

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

        $this->command->info('Đã tạo xong Orders + OrderItems thành công!');
    }
}
