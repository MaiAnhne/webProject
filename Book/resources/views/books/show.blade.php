<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">📖 Chi tiết sách</h1>
            <a href="{{ route('books.index') }}" class="text-blue-500 hover:underline">← Quay lại danh sách</a>
        </div>

        <div class="space-y-4 text-gray-800">
            <div>
                <strong class="block text-gray-600">Tiêu đề:</strong>
                <p class="text-lg font-semibold">{{ $book->title }}</p>
            </div>

            <div>
                <strong class="block text-gray-600">Tác giả:</strong>
                <p>{{ $book->author }}</p>
            </div>

            <div>
                <strong class="block text-gray-600">Giá bán:</strong>
                <p class="text-red-600 font-semibold">{{ number_format($book->price) }}đ</p>
            </div>

            <div>
                <strong class="block text-gray-600">Mô tả:</strong>
                <p class="whitespace-pre-line">{{ $book->description ?? 'Không có mô tả' }}</p>
            </div>
        </div>

        <div class="mt-6 flex gap-4">
            <a href="{{ route('books.edit', $book) }}" class="bg-yellow-400 text-white px-4 py-2 rounded hover:bg-yellow-500">✏️ Sửa</a>

            <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xoá sách này?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">🗑️ Xoá</button>
            </form>
        </div>
    </div>
</x-app-layout>
