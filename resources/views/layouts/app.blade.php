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

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        #cart {
            border-top: 2px solid #ccc;
            padding-top: 1rem;
        }
        #cart-items li {
            transition: background-color 0.2s ease;
        }
        #cart-items li:hover {
            background-color: #fef2f2;
        }
        #cart-count {
            transition: background-color 0.3s, transform 0.3s;
        }
        #cart-count.flash {
            background-color: #22c55e !important;
            transform: scale(1.2);
        }
    </style>
</head>
<body class="bg-white font-['Roboto']">
    <!-- Header -->
    <header class="bg-cyan-500 text-white shadow">
        <div class="container mx-auto flex items-center justify-between px-4 py-3">
            <!-- Logo -->
            <div class="flex items-center gap-2 text-2xl font-bold">
                <img src="/images/logo.png" alt="Hihi Shop Logo" class="w-8 h-8">
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
                <a href="#" onclick="toggleCart()" class="flex items-center hover:underline">
                    🛒 Giỏ hàng <span class="ml-1 bg-yellow-400 text-black px-2 rounded" id="cart-count">0</span>
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
                    <li><a href="#" onclick="filterBooks('Bán chạy tuần')" class="hover:text-blue-600">Sách bán chạy trong tuần</a></li>
                    <li><a href="#" onclick="filterBooks('Bán chạy tháng')" class="hover:text-blue-600">Sách bán chạy trong tháng</a></li>
                    <li><a href="#" onclick="filterBooks('Mới xuất bản')" class="hover:text-blue-600">Sách mới xuất bản</a></li>
                    <li><a href="#" onclick="filterBooks('Tiếng Việt')" class="hover:text-blue-600">Sách Tiếng Việt</a></li>
                    <li><a href="#" onclick="filterBooks('Tiếng Anh')" class="hover:text-blue-600">Sách Tiếng Anh</a></li>
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
        <div id="book-list" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6"></div>

        <div id="cart" class="mt-8">
            <h3 class="text-lg font-semibold mb-2">🛒 Giỏ hàng</h3>
            <ul id="cart-items" class="space-y-2"></ul>
            <p id="empty-cart-msg" class="text-gray-500 italic">Chưa có sản phẩm nào trong giỏ hàng.</p>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white text-center py-6 text-sm text-gray-500 border-t">
        © {{ date('Y') }} Hihi Shop. All rights reserved.
    </footer>

    <!-- Scripts -->
    <script>
        const books = [
            { title: "Tôi thấy hoa vàng trên cỏ xanh", price: "79.000đ", img: "/books/book1.jpg", category: "Văn Học" },
            { title: "Cánh đồng bất tận", price: "85.000đ", img: "/books/book2.jpg", category: "Văn Học" },
            { title: "Người lái đò sông Đà", price: "69.000đ", img: "/books/book3.jpg", category: "Văn Học" },
            { title: "Đắc Nhân Tâm", price: "98.000đ", img: "/books/book4.jpg", category: "Kỹ Năng" },
            { title: "Người bán hàng vĩ đại nhất", price: "86.000đ", img: "/books/book5.jpg", category: "Kỹ Năng" },
            { title: "Tư duy nhanh và chậm", price: "140.000đ", img: "/books/book6.jpg", category: "Kinh Tế" },
            { title: "Harry Potter và Hòn Đá Phù Thủy", price: "120.000đ", img: "/books/book7.jpg", category: "Thiếu Nhi" },
            { title: "Doraemon - Tập 1", price: "25.000đ", img: "/books/book8.jpg", category: "Thiếu Nhi" },
            { title: "Pháo đài số", price: "180.000đ", img: "/books/book9.jpg", category: "Kinh Tế" },
            { title: "Cha giàu cha nghèo", price: "99.000đ", img: "/books/book10.jpg", category: "Kinh Tế" },
            { title: "Nuôi con không phải cuộc chiến", price: "105.000đ", img: "/books/book11.jpg", category: "Nuôi Dạy Con" },
            { title: "Cha mẹ Nhật dạy con tự lập", price: "110.000đ", img: "/books/book12.jpg", category: "Nuôi Dạy Con" },
            { title: "Lược sử loài người", price: "150.000đ", img: "/books/book7.jpg", category: "Bán chạy tuần" },
            { title: "Think and Grow Rich", price: "135.000đ", img: "/books/book8.jpg", category: "Bán chạy tháng" },
            { title: "Hành tinh của một kẻ nghĩ nhiều", price: "99.000đ", img: "/books/book9.jpg", category: "Mới xuất bản" },
            { title: "Bí mật của Naoko", price: "110.000đ", img: "/books/book10.jpg", category: "Tiếng Việt" },
            { title: "The Alchemist", price: "125.000đ", img: "/books/book11.jpg", category: "Tiếng Anh" },
            { title: "7 Thói quen hiệu quả", price: "145.000đ", img: "/books/book12.jpg", category: "Kỹ Năng, Bán chạy tuần" },
            { title: "Sapiens", price: "170.000đ", img: "/books/book13.jpg", category: "Mới xuất bản, Kinh Tế" },
        ];


        const cart = [];

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
                        <button onclick='addToCart("${b.title}")' class="mt-2 w-full bg-blue-500 text-white text-sm py-1 rounded hover:bg-blue-600">Thêm vào giỏ</button>
                    </div>
                `;
                list.appendChild(card);
            });
        }

        function addToCart(title) {
            const book = books.find(b => b.title === title);
            if (!cart.find(i => i.title === title)) cart.push(book);
            renderCart();
            flashCart();
        }

        function renderCart() {
            const list = document.getElementById("cart-items");
            const emptyMsg = document.getElementById("empty-cart-msg");
            list.innerHTML = "";
            if (cart.length === 0) {
                emptyMsg.style.display = "block";
            } else {
                emptyMsg.style.display = "none";
                cart.forEach((item, index) => {
                    const li = document.createElement("li");
                    li.className = "flex justify-between items-center bg-gray-100 px-3 py-2 rounded";
                    li.innerHTML = `
                        <span>${item.title}</span>
                        <button onclick="removeFromCart(${index})" class="text-red-500 hover:underline">Xóa</button>
                    `;
                    list.appendChild(li);
                });
            }
            document.getElementById("cart-count").textContent = cart.length;
        }

        function removeFromCart(index) {
            cart.splice(index, 1);
            renderCart();
        }

        function toggleCart() {
            const cartSection = document.getElementById("cart");
            cartSection.scrollIntoView({ behavior: "smooth" });
        }

        function filterBooks(category) {
            if (category === "Tất cả") return renderBooks();
            renderBooks(books.filter(b => b.category.includes(category)));
        }

        function flashCart() {
            const cartCount = document.getElementById("cart-count");
            cartCount.classList.add("flash");
            setTimeout(() => {
                cartCount.classList.remove("flash");
            }, 500);
        }

        renderBooks();
    </script>
</body>
</html>
