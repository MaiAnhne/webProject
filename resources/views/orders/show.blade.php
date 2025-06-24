<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chi tiết đơn hàng') }} #{{ $order->id }}
        </h2>
    </x-slot>
    
    <x-category-menu />

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4">
            <div class="bg-white dark:bg-gray-800 p-6 shadow rounded-lg border dark:border-gray-700">
                <p class="text-lg mb-4 font-semibold text-gray-700 dark:text-gray-300">
                    🧾 Tổng cộng: 
                    <span class="text-blue-600 font-bold text-xl">
                        {{ number_format($order->total, 0, ',', '.') }}đ
                    </span>
                </p>

                <ul class="space-y-4">
                    @foreach($order->items as $item)
                        <li class="border-b pb-4 flex gap-4">
                            <img src="{{ $item->book->image_url }}" alt="{{ $item->book->title }}" class="w-20 h-28 object-cover rounded shadow" />
                            <div class="flex-1 text-gray-800 dark:text-gray-200">
                                <div class="font-medium text-lg">
                                    📚 {{ $item->book->title }}
                                </div>
                                <div class="text-sm">📦 Số lượng: {{ $item->quantity }}</div>
                                <div class="text-sm">💵 Đơn giá: {{ number_format($item->price, 0, ',', '.') }}đ</div>
                                <div class="text-sm text-green-600 font-semibold mt-1">
                                    ➕ Thành tiền: {{ number_format($item->quantity * $item->price, 0, ',', '.') }}đ
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <a href="{{ route('orders.index') }}" class="text-blue-600 hover:underline mt-6 inline-block">
                    ← Quay về danh sách đơn hàng
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
