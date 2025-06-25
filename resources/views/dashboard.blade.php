<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Menu danh mục -->
    <x-category-menu />

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-gray-900 dark:text-white">
                    🎉 Chào mừng bạn đến với trang quản lý sách!
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
