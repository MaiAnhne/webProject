<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">📝 Tạo đơn hàng mới</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto bg-white shadow rounded p-6">
            <form method="POST" action="{{ route('orders.store') }}">
                @csrf

                <div class="mb-4">
                    <label class="block font-medium mb-1">Tên người nhận</label>
                    <input type="text" name="receiver_name" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1">Địa chỉ giao hàng</label>
                    <input type="text" name="shipping_address" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1">Số điện thoại</label>
                    <input type="text" name="phone" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-6">
                    <label class="block font-medium mb-1">Ghi chú</label>
                    <textarea name="note" class="w-full border rounded px-3 py-2" rows="3"></textarea>
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    ✅ Đặt hàng
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
