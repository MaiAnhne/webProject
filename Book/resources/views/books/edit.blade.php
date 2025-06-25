<x-app-layout>
    <div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded mt-6">
        <h1 class="text-xl font-bold mb-4">✏️ Sửa sách</h1>

        @if ($errors->any())
            <div class="mb-4 text-red-500">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('books.update', $book->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-semibold">Tên sách:</label>
                <input type="text" name="title" value="{{ $book->title }}" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Tác giả:</label>
                <input type="text" name="author" value="{{ $book->author }}" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Giá:</label>
                <input type="number" name="price" value="{{ $book->price }}" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Mô tả:</label>
                <textarea name="description" rows="3" class="w-full border rounded px-3 py-2">{{ $book->description }}</textarea>
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Cập nhật</button>
            <a href="{{ route('books.index') }}" class="ml-3 text-gray-600 hover:underline">Quay lại</a>
        </form>
    </div>
</x-app-layout>
