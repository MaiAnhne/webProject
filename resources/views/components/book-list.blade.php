<section class="px-6 py-4">
    <h2 class="text-xl font-bold mb-3">📘 Sách mới</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
        @forelse ($books as $book)
            <div class="bg-white shadow rounded overflow-hidden hover:shadow-md transition">
                <img src="{{ $book->cover_url ?? 'https://via.placeholder.com/150' }}" class="w-full h-40 object-cover" alt="{{ $book->title }}">
                <div class="p-2">
                    <h3 class="font-semibold text-sm truncate">{{ $book->title }}</h3>
                    <p class="text-xs text-gray-500">{{ $book->author }}</p>
                    <p class="text-red-500 font-bold mt-1">{{ number_format($book->price) }}₫</p>
                    <a href="#" class="block w-full mt-2 bg-red-500 text-white text-center rounded py-1 text-sm">🛒 Thêm giỏ</a>
                </div>
            </div>
        @empty
            <p>Không có sách nào để hiển thị.</p>
        @endforelse
    </div>
</section>
