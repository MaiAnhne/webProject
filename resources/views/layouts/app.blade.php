<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hihi Shop</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <style>
    body { font-family: 'Roboto', sans-serif; }
    #cart-count { transition: background-color 0.3s, transform 0.3s; }
    #cart-count.flash { background-color: #22c55e !important; transform: scale(1.2); }
  </style>
</head>
<body class="bg-gradient-to-b from-cyan-100 to-white font-['Roboto']">
  <header class="bg-cyan-500 text-white py-4 shadow-md">
    <div class="container mx-auto flex justify-between items-center px-4">
      <h1 class="text-2xl font-bold tracking-wide flex items-center gap-2">📚 <span>Hihi Shop</span></h1>
      <input type="text" placeholder="Tìm kiếm sách..." class="w-1/2 px-4 py-2 rounded border focus:outline-none focus:ring-2 focus:ring-cyan-300">
      <div class="flex items-center gap-4">
        <span class="hidden sm:block">Nguyễn Mai Anh</span>
        <a href="#" class="hover:underline hidden sm:block">Đăng xuất</a>
        <div class="flex items-center gap-2 cursor-pointer relative" onclick="openCart()">
          🛒 Giỏ hàng 
          <span id="cart-count" class="ml-1 px-2 py-1 bg-yellow-400 text-sm font-semibold rounded-full text-white shadow-md">0</span>
        </div>
      </div>
    </div>
  </header>

  <main class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-semibold mb-4 text-center text-cyan-800">📚 Sách Mới Nhất</h2>
    <div id="book-list" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6"></div>
  </main>

  <div id="slide-cart" class="fixed top-0 right-0 h-full w-80 bg-white shadow-xl border-l z-50 transform translate-x-full transition-transform duration-300 ease-in-out">
    <div class="p-4 border-b flex justify-between items-center">
      <h3 class="text-lg font-semibold">🛒 Giỏ hàng</h3>
      <button onclick="closeCart()" class="text-gray-600 hover:text-red-500 text-xl">&times;</button>
    </div>
    <ul id="slide-cart-items" class="p-4 space-y-2 overflow-y-auto h-[calc(100%-200px)]"></ul>
    <div class="px-4 py-3 border-t">
      <p id="slide-empty-cart-msg" class="text-gray-500 italic">Chưa có sản phẩm nào trong giỏ hàng.</p>
      <div id="cart-summary" class="hidden">
        <div class="flex justify-between font-medium mt-2">
          <span>Tổng:</span>
          <span id="total-price" class="text-red-500 font-semibold">0đ</span>
        </div>
        <button onclick="checkout()" class="mt-4 w-full bg-green-500 text-white py-2 rounded hover:bg-green-600 font-semibold">Thanh toán</button>
      </div>
    </div>
  </div>

  <footer class="bg-white text-center py-6 text-sm text-gray-500 border-t shadow-inner mt-12">
    © 2025 Hihi Shop. All rights reserved.
  </footer>

  <script>
    const books = [
      { title: "Tôi thấy hoa vàng trên cỏ xanh", price: "79000đ", img: "/books/book1.jpg", category: "Văn Học" },
      { title: "Cánh đồng bất tận", price: "85000đ", img: "/books/book2.jpg", category: "Văn Học" },
      { title: "Người lái đò sông Đà", price: "69000đ", img: "/books/book3.jpg", category: "Văn Học" },
      { title: "Đắc Nhân Tâm", price: "98000đ", img: "/books/book4.jpg", category: "Kỹ Năng" },
      { title: "Người bán hàng vĩ đại nhất", price: "86000đ", img: "/books/book5.jpg", category: "Kỹ Năng" },
      { title: "Tư duy nhanh và chậm", price: "140000đ", img: "/books/book6.jpg", category: "Kinh Tế" },
      { title: "Cha giàu cha nghèo", price: "99000đ", img: "/books/book7.jpg", category: "Kinh Tế" },
      { title: "Lược sử loài người", price: "150000đ", img: "/books/book8.jpg", category: "Khoa học" },
      { title: "Thám tử Conan tập 1", price: "30000đ", img: "/books/book9.jpg", category: "Thiếu Nhi" },
      { title: "Bố già", price: "125000đ", img: "/books/book10.jpg", category: "Tiểu Thuyết" },
      { title: "Atomic Habits", price: "135000đ", img: "/books/book11.jpg", category: "Phát triển bản thân" },
      { title: "Think and Grow Rich", price: "99000đ", img: "/books/book12.jpg", category: "Kinh Tế" },
      { title: "Doraemon tuyển tập đặc biệt", price: "55000đ", img: "/books/book13.jpg", category: "Thiếu Nhi" },
      { title: "Hành tinh của một kẻ nghĩ nhiều", price: "89000đ", img: "/books/book14.jpg", category: "Tâm Lý" },
      { title: "Sherlock Holmes toàn tập", price: "199000đ", img: "/books/book15.jpg", category: "Trinh Thám" },
      { title: "Chuyện con mèo dạy hải âu bay", price: "45000đ", img: "/books/book16.jpg", category: "Thiếu Nhi" },
      { title: "Nhà giả kim", price: "105000đ", img: "/books/book17.jpg", category: "Văn Học" },
      { title: "Tuổi trẻ đáng giá bao nhiêu", price: "99000đ", img: "/books/book18.jpg", category: "Phát triển bản thân" },
      { title: "7 Thói quen để thành đạt", price: "115000đ", img: "/books/book19.jpg", category: "Kỹ Năng" },
      { title: "Sapiens: Lược sử loài người", price: "175000đ", img: "/books/book20.jpg", category: "Lịch Sử" }
    ];

    const cart = [];

    function renderBooks(filtered = books) {
      const list = document.getElementById("book-list");
      list.innerHTML = "";
      filtered.forEach(b => {
        const card = document.createElement("div");
        card.className = "bg-white shadow rounded overflow-hidden hover:shadow-lg transition duration-200";
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
      renderSlideCart();
      flashCart();
      openCart();
    }

    function removeFromCart(index) {
      cart.splice(index, 1);
      renderSlideCart();
    }

    function renderSlideCart() {
      const list = document.getElementById("slide-cart-items");
      const emptyMsg = document.getElementById("slide-empty-cart-msg");
      const summary = document.getElementById("cart-summary");
      const totalPriceEl = document.getElementById("total-price");

      list.innerHTML = "";

      if (cart.length === 0) {
        emptyMsg.style.display = "block";
        summary.classList.add("hidden");
      } else {
        emptyMsg.style.display = "none";
        summary.classList.remove("hidden");

        let total = 0;
        cart.forEach((item, index) => {
          const priceNum = parseInt(item.price.replace(".000đ", "000"));
          total += priceNum;

          const li = document.createElement("li");
          li.className = "flex justify-between items-center bg-gray-100 px-3 py-2 rounded";
          li.innerHTML = `
            <span>${item.title}</span>
            <button onclick="removeFromCart(${index})" class="text-red-500 hover:underline">Xóa</button>
          `;
          list.appendChild(li);
        });

        totalPriceEl.textContent = total.toLocaleString("vi-VN") + "đ";
      }

      document.getElementById("cart-count").textContent = cart.length;
    }

    function openCart() {
      document.getElementById("slide-cart").classList.remove("translate-x-full");
    }

    function closeCart() {
      document.getElementById("slide-cart").classList.add("translate-x-full");
    }

    function checkout() {
      alert("🛍️ Cảm ơn bạn đã mua hàng! (Chức năng thanh toán đang phát triển)");
      cart.length = 0;
      renderSlideCart();
      closeCart();
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
