<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Danh mục -->
    <x-category-menu />

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg p-6">
                <div class="text-gray-900 dark:text-white text-lg font-semibold">
                    🎉 Bạn đã đăng nhập thành công!
                </div>
                <p class="text-gray-600 dark:text-gray-300 mt-2">
                    Đây là hệ thống quản lý bán sách. Bạn có thể xem đơn hàng, quản lý sách, và nhiều hơn nữa.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>