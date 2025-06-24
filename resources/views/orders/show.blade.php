<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chi tiết đơn hàng') }} #{{ $order->id }}
        </h2>
    </x-slot>

    <!-- Category Menu -->
    <x-category-menu />

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4">
            <div class="bg-white dark:bg-gray-800 p-6 shadow rounded-lg border dark:border-gray-700">
                <p class="text-lg mb-4 font-semibold text-gray-700 dark:text-gray-300">
                    Tổng cộng: <span class="text-blue-600">${{ $order->total }}</span>
                </p>

                <ul class="space-y-4">
                    @foreach($order->items as $item)
                        <li class="border-b pb-2 text-gray-800 dark:text-gray-200">
                            <div class="font-medium">
                                📚 Sách: {{ $item->book->title }}
                            </div>
                            <div class="text-sm">
                                📦 Số lượng: {{ $item->quantity }}
                            </div>
                            <div class="text-sm">
                                💵 Đơn giá: ${{ $item->price }}
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
