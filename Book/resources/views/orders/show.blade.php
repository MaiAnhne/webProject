<h1>Chi tiết đơn hàng #{{ $order->id }}</h1>
<p>Tổng: ${{ $order->total }}</p>
<ul>
    @foreach($order->items as $item)
        <li>
            Sách: {{ $item->book->title }} -
            Số lượng: {{ $item->quantity }} -
            Đơn giá: ${{ $item->price }}
        </li>
    @endforeach
</ul>
