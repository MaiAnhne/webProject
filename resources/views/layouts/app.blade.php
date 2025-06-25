<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Bookstore') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
<div class="min-h-screen">

    <!-- 🌐 Header Tiki Style -->
    <header class="bg-cyan-500 text-white py-4 px-6 shadow flex flex-col md:flex-row md:justify-between md:items-center gap-3">
        <!-- Logo -->
        <div class="flex items-center space-x-2 text-2xl font-bold">
            <img src="/logo.png" alt="Logo" class="w-8 h-8">
            <span>Tiki Books</span>
        </div>

        <!-- Search box -->
        <div class="w-full md:w-1/2">
            <input type="text" placeholder="Tìm kiếm sách, tác giả..." class="w-full px-4 py-2 text-black rounded focus:outline-none" />
        </div>

        <!-- Auth links -->
        <div class="flex items-center space-x-4">
            @auth
                <span>{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="hover:underline">Đăng xuất</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="hover:underline">Đăng nhập</a>
                <a href="{{ route('register') }}" class="hover:underline">Đăng ký</a>
            @endauth
            <a href="#" class="hover:underline flex items-center">
                🛒 Giỏ hàng <span class="ml-1 bg-yellow-400 text-black rounded px-2">2</span>
            </a>
        </div>
    </header>

    <!-- 🔥 Banner sale -->
    <div class="bg-blue-100 text-center py-3 text-blue-800 font-semibold text-lg">
        🔥 SĂN DEAL GIÁ SỐC – GIẢM ĐẾN 50% 🔥
    </div>

    <!-- 📚 Danh mục điều hướng -->
    <nav class="bg-white px-6 py-2 shadow-sm flex gap-4 overflow-x-auto whitespace-nowrap text-sm font-medium">
        <a href="#" class="hover:text-blue-600">Sách Văn học</a>
        <a href="#" class="hover:text-blue-600">Kinh tế</a>
        <a href="#" class="hover:text-blue-600">Thiếu nhi</a>
        <a href="#" class="hover:text-blue-600">Tâm lý</a>
        <a href="#" class="hover:text-blue-600">Nuôi dạy con</a>
        <a href="#" class="hover:text-blue-600">Giáo khoa</a>
        <a href="#" class="hover:text-blue-600">Tất cả</a>
    </nav>

    <!-- ✅ Nội dung chính -->
    <main class="p-6">
        {{ $slot }}
    </main>
</div>
</body>
</html>
