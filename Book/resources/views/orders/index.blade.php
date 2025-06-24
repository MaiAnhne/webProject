<h1>Đơn hàng của bạn</h1>
@foreach ($orders as $order)
    <div>
        <h3>Đơn #{{ $order->id }} - Tổng: ${{ $order->total }}</h3>
        <a href="{{ route('orders.show', $order) }}">Chi tiết</a>
    </div>
@endforeach
