@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Danh sách sách</h1>

<a href="{{ route('books.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow mb-4 inline-block">
    ➕ Thêm mới
</a>

<div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-lg">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">#</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Ảnh</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Tiêu đề</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Tác giả</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Giá</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Hành động</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
            @foreach($books as $book)
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                <td class="px-4 py-2">{{ $book->id }}</td>
                <td class="px-4 py-2">
                    <img src="{{ $book->image_url }}" alt="{{ $book->title }}" class="w-12 h-16 object-cover rounded" />
                </td>
                <td class="px-4 py-2">{{ $book->title }}</td>
                <td class="px-4 py-2">{{ $book->author }}</td>
                <td class="px-4 py-2 text-green-600">{{ number_format($book->price, 0, ',', '.') }}đ</td>
                <td class="px-4 py-2 space-x-2">
                    <a href="{{ route('books.show', $book) }}" class="text-blue-600 hover:underline">Xem</a>
                    <a href="{{ route('books.edit', $book) }}" class="text-yellow-500 hover:underline">Sửa</a>
                    <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="text-red-600 hover:underline">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
