<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">🧾 Chi tiết đơn hàng #{{ $order->id }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto bg-white shadow rounded p-6 space-y-4">
            <p><strong>📅 Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>👤 Người nhận:</strong> {{ $order->receiver_name }}</p>
            <p><strong>📍 Địa chỉ:</strong> {{ $order->shipping_address }}</p>
            <p><strong>📞 Số điện thoại:</strong> {{ $order->phone }}</p>
            <p><strong>📝 Ghi chú:</strong> {{ $order->note ?? 'Không có' }}</p>
            <p><strong>📦 Trạng thái:</strong> {{ $order->status }}</p>
            <p><strong>💰 Tổng tiền:</strong> <span class="text-red-500 font-bold">{{ number_format($order->total, 0, ',', '.') }}đ</span></p>

            <hr>

            <h3 class="text-lg font-semibold mt-4">📚 Sản phẩm đã đặt</h3>
            <ul class="divide-y">
                @foreach ($order->items as $item)
                    <li class="py-2 flex justify-between">
                        <span>{{ $item->book->title }} x{{ $item->quantity }}</span>
                        <span class="text-red-500">{{ number_format($item->subtotal, 0, ',', '.') }}đ</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>
