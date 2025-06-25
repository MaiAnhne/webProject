<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hihi Shop</title>

    <!-- Fonts & Tailwind -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white font-['Roboto']">
    <!-- Header -->
    <header class="bg-cyan-500 text-white shadow">
        <div class="container mx-auto flex items-center justify-between px-4 py-3">
            <!-- Logo -->
            <div class="flex items-center gap-2 text-2xl font-bold">
                <img src="/logo-hihi.png" alt="Hihi Shop Logo" class="w-8 h-8">
                <span>Hihi Shop</span>
            </div>

            <!-- Search -->
            <div class="flex-1 max-w-lg mx-4">
                <input type="text" placeholder="Nhập tên sách, tác giả, công ty phát hành..." class="w-full px-4 py-2 rounded-md text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>

            <!-- Auth -->
            <div class="flex items-center space-x-4 text-sm">
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
                <a href="#" class="flex items-center hover:underline">
                    🛒 Giỏ hàng <span class="ml-1 bg-yellow-400 text-black px-2 rounded">2</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Category Sidebar + Banner -->
    <div class="bg-white shadow border-b">
        <div class="container mx-auto flex">
            <!-- Sidebar -->
            <aside class="w-64 p-4 hidden lg:block">
                <ul class="space-y-2 text-sm text-gray-700">
                    <li><a href="#" class="hover:text-blue-600">Sách bán chạy trong tuần</a></li>
                    <li><a href="#" class="hover:text-blue-600">Sách bán chạy trong tháng</a></li>
                    <li><a href="#" class="hover:text-blue-600">Sách mới xuất bản</a></li>
                    <li><a href="#" class="hover:text-blue-600">Sách Tiếng Việt</a></li>
                    <li><a href="#" class="hover:text-blue-600">Sách Tiếng Anh</a></li>
                </ul>
            </aside>

            <!-- Banner -->
            <div class="flex-1 bg-blue-50 p-4">
                <img src="/banner-sale.jpg" alt="Sale banner" class="w-full rounded shadow">
                <div class="mt-2 text-blue-800 font-semibold text-center">
                    SĂN DEAL GIÁ SỐC – THỨ 4 HÀNG TUẦN 🔥 GIẢM ĐẾN 50%
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="bg-white shadow text-sm font-medium border-b">
        <div class="container mx-auto flex gap-6 overflow-x-auto px-4 py-3 whitespace-nowrap">
            <a href="#" class="hover:text-blue-600">Sách Văn Học</a>
            <a href="#" class="hover:text-blue-600">Sách Thiếu Nhi</a>
            <a href="#" class="hover:text-blue-600">Sách Kỹ Năng - Sống Đẹp</a>
            <a href="#" class="hover:text-blue-600">Sách Kinh Tế</a>
            <a href="#" class="hover:text-blue-600">Sách Nuôi Dạy Con</a>
            <a href="#" class="hover:text-blue-600">Tất cả Sách</a>
        </div>
    </nav>

    <!-- Product section mockup -->
    <main class="container mx-auto px-4 py-6">
        <h2 class="text-xl font-semibold mb-4">📚 Sách Mới</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
            <!-- Sample book card -->
            <div class="bg-white shadow rounded overflow-hidden">
                <img src="/books/book1.jpg" alt="book" class="w-full h-48 object-cover">
                <div class="p-3">
                    <h3 class="text-sm font-semibold">Tôi thấy hoa vàng trên cỏ xanh</h3>
                    <p class="text-red-500 font-bold mt-1">79.000đ</p>
                    <button class="mt-2 w-full bg-blue-500 text-white text-sm py-1 rounded hover:bg-blue-600">Thêm vào giỏ</button>
                </div>
            </div>
            <!-- Repeat more cards -->
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white text-center py-6 text-sm text-gray-500 border-t">
        © {{ date('Y') }} Hihi Shop. All rights reserved.
    </footer>
</body>
</html>
