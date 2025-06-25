<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">📝 Tạo đơn hàng mới</h2>
    </x-slot>

    <div class="py-8 bg-white">
        <div class="max-w-3xl mx-auto px-4">
            <form action="{{ route('orders.store') }}" method="POST" class="space-y-6">
                @csrf

                @foreach ($books as $book)
                    <div class="flex items-center justify-between border-b pb-2">
                        <div>
                            <h3 class="font-semibold text-gray-800">{{ $book->title }}</h3>
                            <p class="text-sm text-gray-500">{{ number_format($book->price, 0, ',', '.') }}đ</p>
                        </div>
                        <input type="number" name="items[{{ $loop->index }}][quantity]" min="0" value="0" class="w-16 border rounded px-2 py-1 text-sm">
                        <input type="hidden" name="items[{{ $loop->index }}][book_id]" value="{{ $book->id }}">
                    </div>
                @endforeach

                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
                    ✅ Xác nhận đặt hàng
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
