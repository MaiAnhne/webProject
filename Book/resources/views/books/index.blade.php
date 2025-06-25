<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">📚 Danh sách sách</h1>
            <a href="{{ route('books.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">➕ Thêm mới</a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white shadow rounded">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-gray-200 text-gray-700 uppercase">
                    <tr>
                        <th class="px-6 py-3">ID</th>
                        <th class="px-6 py-3">Tiêu đề</th>
                        <th class="px-6 py-3">Tác giả</th>
                        <th class="px-6 py-3">Giá</th>
                        <th class="px-6 py-3">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-3">{{ $book->id }}</td>
                        <td class="px-6 py-3 font-medium">{{ $book->title }}</td>
                        <td class="px-6 py-3">{{ $book->author }}</td>
                        <td class="px-6 py-3 text-red-600 font-semibold">{{ number_format($book->price) }}đ</td>
                        <td class="px-6 py-3 space-x-2">
                            <a href="{{ route('books.show', $book) }}" class="text-blue-500 hover:underline">Xem</a>
                            <a href="{{ route('books.edit', $book) }}" class="text-yellow-500 hover:underline">Sửa</a>
                            <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline-block" onsubmit="return confirm('Bạn có chắc muốn xoá sách này?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Xoá</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
