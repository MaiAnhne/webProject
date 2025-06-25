<div class="bg-white shadow rounded overflow-hidden">
    <img src="{{ $book->image_url }}" alt="{{ $book->title }}" class="w-full h-48 object-cover">
    <div class="p-3">
        <h3 class="text-sm font-semibold">{{ $book->title }}</h3>
        <p class="text-red-500 font-bold mt-1">{{ number_format($book->price, 0, ',', '.') }}đ</p>
        <form action="{{ route('cart.add', $book->id) }}" method="POST">
            @csrf
            <button class="mt-2 w-full bg-blue-500 text-white text-sm py-1 rounded hover:bg-blue-600">Thêm vào giỏ</button>
        </form>
    </div>
</div>
