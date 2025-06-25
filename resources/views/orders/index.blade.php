<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            📦 Đơn hàng của bạn
        </h2>
    </x-slot>

    <div class="py-10 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <!-- Danh mục -->
            <div class="mb-6 bg-white border border-gray-200 shadow-sm rounded-lg p-4 flex flex-wrap gap-4 text-sm font-medium">
                <a href="#" class="hover:text-blue-600">📚 Văn học</a>
                <a href="#" class="hover:text-blue-600">💼 Kinh tế</a>
                <a href="#" class="hover:text-blue-600">🎈 Thiếu nhi</a>
                <a href="#" class="hover:text-blue-600">🧠 Tâm lý</a>
                <a href="#" class="hover:text-blue-600">👨‍👩‍👧‍👦 Nuôi dạy con</a>
                <a href="#" class="hover:text-blue-600">📘 Giáo khoa</a>
            </div>

            <!-- Danh sách đơn hàng -->
            <h1 class="text-xl font-bold mb-4">📄 Danh sách đơn hàng</h1>

            @forelse ($orders as $order)
                <div class="bg-gray-50 border border-gray-200 rounded-md p-4 mb-4 shadow-sm">
                    <h3 class="font-semibold text-gray-800">🧾 Đơn #{{ $order->id }}</h3>
                    <p class="text-sm text-gray-600 mt-1">📅 Ngày đặt: {{ $order->created_at->format('d/m/Y') }}</p>
                    <p class="text-sm text-gray-600">💰 Tổng tiền: <span class="text-red-500 font-semibold">{{ number_format($order->total, 0, ',', '.') }}đ</span></p>
                    <p class="text-sm text-gray-600">📦 Trạng thái: <span class="font-medium">{{ $order->status }}</span></p>
                </div>
            @empty
                <p class="text-gray-500">Bạn chưa có đơn hàng nào.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
