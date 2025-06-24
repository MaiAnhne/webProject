<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tạo đơn hàng') }}
        </h2>
    </x-slot>

    <!-- Category Menu -->
    <x-category-menu />

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white dark:bg-gray-800 p-6 shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf

                    @foreach ($books as $book)
                        <div class="mb-4 border-b pb-2">
                            <label class="flex items-center space-x-3">
                                <input type="checkbox"
                                       name="items[{{ $loop->index }}][book_id]"
                                       value="{{ $book->id }}"
                                       class="form-checkbox h-5 w-5 text-blue-600">
                                <span class="text-gray-800 dark:text-gray-100">
                                    {{ $book->title }} - ${{ $book->price }}
                                </span>
                            </label>
                            <label class="block mt-2 text-sm text-gray-600 dark:text-gray-300">
                                Số lượng:
                                <input type="number"
                                       name="items[{{ $loop->index }}][quantity]"
                                       value="1" min="1"
                                       class="ml-2 w-16 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                            </label>
                        </div>
                    @endforeach

                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">
                        Đặt hàng
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
