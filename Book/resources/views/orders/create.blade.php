<h1>Tạo đơn hàng</h1>
<form action="{{ route('orders.store') }}" method="POST">
    @csrf
    @foreach ($books as $book)
        <div>
            <input type="checkbox" name="items[{{ $loop->index }}][book_id]" value="{{ $book->id }}">
            {{ $book->title }} - ${{ $book->price }}
            Số lượng: <input type="number" name="items[{{ $loop->index }}][quantity]" value="1" min="1">
        </div>
    @endforeach
    <button type="submit">Đặt hàng</button>
</form>
