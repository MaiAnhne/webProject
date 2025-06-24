<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Đơn hàng của bạn') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <!-- Category Menu -->
        <div class="bg-white shadow-sm border-t border-gray-200 dark:border-gray-700">
            <div class="max-w-7xl mx-auto px-4 py-2 flex space-x-6 text-sm font-medium text-gray-700 dark:text-gray-300">
                <a href="#" class="hover:text-blue-600">📚 Văn học</a>
                <a href="#" class="hover:text-blue-600">💼 Kinh tế</a>
                <a href="#" class="hover:text-blue-600">👶 Thiếu nhi</a>
                <a href="#" class="hover:text-blue-600">🧠 Tâm lý</a>
                <a href="#" class="hover:text-blue-600">👨‍👩‍👧‍👦 Nuôi dạy con</a>
                <a href="#" class="hover:text-blue-600">📖 Giáo khoa</a>
            </div>
        </div>

        <!-- Danh sách đơn hàng -->
        <div class="max-w-7xl mx-auto px-4 mt-6 space-y-4">
            <h1 class="text-xl font-bold mb-4">Đơn hàng của bạn</h1>

            @foreach ($orders as $order)
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-4 border border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                        Đơn #{{ $order->id }} – Tổng: ${{ $order->total }}
                    </h3>
                    <a href="{{ route('orders.show', $order) }}" class="text-blue-600 hover:underline mt-2 inline-block">Chi tiết</a>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
