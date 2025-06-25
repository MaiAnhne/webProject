<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📚 Danh sách sách
        </h2>
    </x-slot>

    <!-- Breadcrumb -->
    <div class="mt-2 mb-4 text-sm text-gray-600">
        <a href="/" class="hover:underline text-blue-600">Trang chủ</a> / 
        <span class="text-gray-800 font-medium">Danh sách sách</span>
    </div>

    <!-- Nút thêm sách mới -->
    @can('create', App\Models\Book::class)
        <div class="mb-4">
            <a href="{{ route('books.create') }}" class="bg-cyan-500 hover:bg-cyan-600 text-white px-4 py-2 rounded shadow">
                ➕ Thêm sách
            </a>
        </div>
    @endcan

    <!-- Grid danh sách sách -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($books as $book)
            <div class="bg-white rounded shadow p-4 flex flex-col">
                <img src="{{ $book->image ?? '/placeholder-book.png' }}" alt="{{ $book->title }}" class="w-full h-48 object-cover rounded mb-3">
                <h3 class="text-md font-semibold text-gray-800 mb-1">{{ $book->title }}</h3>
                <p class="text-sm text-gray-600 italic">{{ $book->author }}</p>
                <p class="text-red-600 font-bold mt-2">{{ number_format($book->price, 0, ',', '.') }} đ</p>

                <div class="mt-auto flex justify-between items-center">
                    <a href="{{ route('books.show', $book) }}" class="text-sm text-blue-600 hover:underline">Chi tiết</a>
                    <form action="{{ route('orders.create') }}" method="GET">
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <button class="text-white bg-yellow-400 hover:bg-yellow-500 px-3 py-1 rounded text-sm">
                            🛒 Thêm
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-600 col-span-4">Không có sách nào.</p>
        @endforelse
    </div>
</x-app-layout>
