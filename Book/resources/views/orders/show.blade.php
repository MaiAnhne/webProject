<h1>Chi tiết đơn hàng #{{ $order->id }}</h1>
<p>Tổng: ${{ $order->total }}</p>
<ul>
    @foreach($order->items as $item)
        <li>{{ $item->book->title }} - SL: {{ $item->quantity }} - Giá: ${{ $item->price }}</li>
    @endforeach
</ul>
