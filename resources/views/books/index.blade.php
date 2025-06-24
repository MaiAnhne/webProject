@extends('layouts.app')
@section('content')
<h1>Danh sách sách</h1>
<a href="{{ route('books.create') }}" class="btn btn-primary">Thêm mới</a>
<table class="table">
    <tr>
        <th>ID</th><th>Tiêu đề</th><th>Tác giả</th><th>Giá</th><th>Hành động</th>
    </tr>
    @foreach($books as $book)
    <tr>
        <td>{{ $book->id }}</td>
        <td>{{ $book->title }}</td>
        <td>{{ $book->author }}</td>
        <td>{{ $book->price }}</td>
        <td>
            <a href="{{ route('books.show', $book) }}" class="btn btn-success">Xem</a>
            <a href="{{ route('books.edit', $book) }}" class="btn btn-warning">Sửa</a>
            <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Xóa</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
