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
            <a href="#" onclick="filterBooks('Văn Học')" class="hover:text-blue-600">Sách Văn Học</a>
            <a href="#" onclick="filterBooks('Thiếu Nhi')" class="hover:text-blue-600">Sách Thiếu Nhi</a>
            <a href="#" onclick="filterBooks('Kỹ Năng')" class="hover:text-blue-600">Sách Kỹ Năng - Sống Đẹp</a>
            <a href="#" onclick="filterBooks('Kinh Tế')" class="hover:text-blue-600">Sách Kinh Tế</a>
            <a href="#" onclick="filterBooks('Nuôi Dạy Con')" class="hover:text-blue-600">Sách Nuôi Dạy Con</a>
            <a href="#" onclick="filterBooks('Tất cả')" class="hover:text-blue-600">Tất cả Sách</a>
        </div>
    </nav>

    <!-- Product section mockup -->
    <main class="container mx-auto px-4 py-6">
        <h2 class="text-xl font-semibold mb-4">📚 Sách Mới</h2>
        <div id="book-list" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
            <template id="book-card-template">
                <div class="bg-white shadow rounded overflow-hidden">
                    <img src="" alt="book" class="w-full h-48 object-cover">
                    <div class="p-3">
                        <h3 class="text-sm font-semibold"></h3>
                        <p class="text-red-500 font-bold mt-1"></p>
                        <button class="mt-2 w-full bg-blue-500 text-white text-sm py-1 rounded hover:bg-blue-600">Thêm vào giỏ</button>
                    </div>
                </div>
            </template>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white text-center py-6 text-sm text-gray-500 border-t">
        © {{ date('Y') }} Hihi Shop. All rights reserved.
    </footer>

    <!-- Filtering logic (functional) -->
    <script>
        const books = [
            // Văn Học
            { title: "Tôi thấy hoa vàng trên cỏ xanh", price: "79.000đ", img: "/books/book1.jpg", category: "Văn Học" },
            { title: "Cánh đồng bất tận", price: "85.000đ", img: "/books/book7.jpg", category: "Văn Học" },
            { title: "Người lái đò sông Đà", price: "69.000đ", img: "/books/book8.jpg", category: "Văn Học" },

            // Kỹ Năng
            { title: "Đắc Nhân Tâm", price: "98.000đ", img: "/books/book2.jpg", category: "Kỹ Năng" },
            { title: "Người bán hàng vĩ đại nhất", price: "86.000đ", img: "/books/book5.jpg", category: "Kỹ Năng" },
            { title: "Tư duy nhanh và chậm", price: "140.000đ", img: "/books/book9.jpg", category: "Kỹ Năng" },

            // Thiếu Nhi
            { title: "Harry Potter và Hòn Đá Phù Thủy", price: "120.000đ", img: "/books/book3.jpg", category: "Thiếu Nhi" },
            { title: "Doraemon - Tập 1", price: "25.000đ", img: "/books/book10.jpg", category: "Thiếu Nhi" },

            // Kinh Tế
            { title: "Pháo đài số", price: "180.000đ", img: "/books/book4.jpg", category: "Kinh Tế" },
            { title: "Cha giàu cha nghèo", price: "99.000đ", img: "/books/book11.jpg", category: "Kinh Tế" },

            // Nuôi Dạy Con
            { title: "Nuôi con không phải cuộc chiến", price: "105.000đ", img: "/books/book6.jpg", category: "Nuôi Dạy Con" },
            { title: "Cha mẹ Nhật dạy con tự lập", price: "110.000đ", img: "/books/book12.jpg", category: "Nuôi Dạy Con" }
        ];

        function renderBooks(filtered = books) {
            const list = document.getElementById("book-list");
            list.innerHTML = "";
            filtered.forEach(b => {
                const card = document.createElement("div");
                card.className = "bg-white shadow rounded overflow-hidden";
                card.innerHTML = `
                    <img src="${b.img}" alt="book" class="w-full h-48 object-cover">
                    <div class="p-3">
                        <h3 class="text-sm font-semibold">${b.title}</h3>
                        <p class="text-red-500 font-bold mt-1">${b.price}</p>
                        <button class="mt-2 w-full bg-blue-500 text-white text-sm py-1 rounded hover:bg-blue-600">Thêm vào giỏ</button>
                    </div>
                `;
                list.appendChild(card);
            });
        }

        function filterBooks(category) {
            if (category === "Tất cả") return renderBooks();
            renderBooks(books.filter(b => b.category.includes(category)));
        }

        // Initial render
        renderBooks();
    </script>
</body>
</html>
