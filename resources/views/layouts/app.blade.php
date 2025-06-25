<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hihi Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    .flash {
      animation: flash 0.5s ease-in-out;
    }
    @keyframes flash {
      0% { background-color: yellow; }
      100% { background-color: transparent; }
    }
  </style>
</head>
<body class="bg-gradient-to-b from-cyan-100 to-white font-['Roboto']">

<!-- Header thông tin user -->
@if (Auth::check())
  <div class="bg-sky-400 text-white text-right px-6 py-2 text-lg font-medium">
    {{ Auth::user()->name }}
    <form method="POST" action="{{ route('logout') }}" class="inline">
      @csrf
      <button type="submit" class="ml-4 hover:underline">Đăng xuất</button>
    </form>
  </div>
@endif

<!-- Sidebar + Banner -->
<div class="flex flex-col lg:flex-row">
  <!-- Sidebar -->
  <aside class="w-full lg:w-64 p-4 border-b lg:border-b-0 lg:border-r bg-white text-center">
    <img src="/images/logoManh.jpg" alt="Hihi Shop Logo" class="mx-auto w-24 h-24 object-contain">
    <h1 class="text-xl font-bold text-blue-600 mt-2 mb-4">Hihi Shop</h1>
    <nav class="space-y-3 text-sm text-gray-700 text-left">
      <a href="#" onclick="filterTag('banchaytuan')" class="block hover:text-blue-600">🔥 Bán chạy tuần</a>
      <a href="#" onclick="filterTag('banchaythang')" class="block hover:text-blue-600">📈 Bán chạy tháng</a>
      <a href="#" onclick="filterTag('moixuatban')" class="block hover:text-blue-600">🆕 Mới xuất bản</a>
      <a href="#" onclick="filterTag('tiengviet')" class="block hover:text-blue-600">🇻🇳 Sách Tiếng Việt</a>
      <a href="#" onclick="filterTag('tienganh')" class="block hover:text-blue-600">🇺🇸 Sách Tiếng Anh</a>
    </nav>
  </aside>

  <!-- Banner -->
  <div class="flex-1 bg-blue-50 p-4 flex flex-col justify-start">
    <img src="/images/banner.jpg" alt="Sale banner" class="w-full max-h-48 object-cover rounded shadow">
    <div class="mt-2 text-blue-800 font-semibold text-center">
      🎉 SĂN DEAL GIÁ SỐC – THỨ 4 HÀNG TUẦN 🔥 GIẢM ĐẾN 50%
    </div>
  </div>
</div>

<!-- Navigation Category Bar -->
<nav class="bg-white shadow text-sm font-medium border-b">
  <div class="container mx-auto flex gap-4 overflow-x-auto px-4 py-3 whitespace-nowrap">
    <a href="#" onclick="filterBooks('Văn Học')" class="hover:text-blue-600 font-semibold">📖 Sách Văn Học</a>
    <a href="#" onclick="filterBooks('Thiếu Nhi')" class="hover:text-blue-600 font-semibold">👶 Sách Thiếu Nhi</a>
    <a href="#" onclick="filterBooks('Kỹ Năng')" class="hover:text-blue-600 font-semibold">💡 Sách Kỹ Năng - Sống Đẹp</a>
    <a href="#" onclick="filterBooks('Kinh Tế')" class="hover:text-blue-600 font-semibold">💰 Sách Kinh Tế</a>
<a href="#" onclick="filterBooks('Nuôi Dạy Con')" class="hover:text-blue-600 font-semibold">👪 Sách Nuôi Dạy Con</a>
    <a href="#" onclick="renderBooks()" class="hover:text-blue-600 font-semibold">📚 Tất cả Sách</a>
  </div>
</nav>

<!-- Search bar -->
<div class="p-4 bg-white shadow sticky top-0 z-40">
  <input type="text" id="search-box" placeholder="Tìm kiếm sách..." oninput="searchBooks()"
         class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-300">
</div>

<!-- Slide Cart Layout -->
<div id="slide-cart" class="fixed top-0 right-0 w-80 bg-white shadow-lg h-full p-4 transform translate-x-full transition duration-300 z-50">
  <h2 class="text-lg font-semibold mb-4">🛒 Giỏ hàng</h2>
  <ul id="slide-cart-items" class="space-y-2 mb-4"></ul>
  <div id="slide-empty-cart-msg" class="text-sm text-gray-500">Chưa có sản phẩm nào.</div>
  <div id="cart-summary" class="mt-4 hidden">
    <div class="text-right font-semibold text-gray-800 mb-2">Tổng: <span id="total-price">0đ</span></div>
    <button onclick="checkout()" class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600">Thanh toán</button>
  </div>
  <button onclick="closeCart()" class="absolute top-2 right-2 text-gray-500 hover:text-red-500">✕</button>
</div>

<!-- Button mở giỏ hàng -->
<div class="fixed top-4 right-4 z-50">
  <button onclick="openCart()" class="relative bg-white border shadow px-4 py-2 rounded-full flex items-center">
    🛍️ Giỏ hàng <span id="cart-count" class="ml-2 bg-yellow-400 text-xs font-bold rounded-full px-2 py-1">0</span>
  </button>
</div>

<!-- Danh sách hiển thị sách (form cũ) -->
<div class="pt-6">
  <div id="book-list" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-4 py-6"></div>
</div>

<script>
const cart = [];
const books = [
  { title: "Tôi thấy hoa vàng trên cỏ xanh", price: "79000đ", img: "/images/toi_thay_hoa_vang.jpg", category: "Văn Học", tag: "banchaytuan,tiengviet" },
  { title: "Cánh đồng bất tận", price: "85000đ", img: "/images/canh-dong-bat-tan.jpg", category: "Văn Học", tag: "tiengviet" },
  { title: "Người lái đò sông Đà", price: "69000đ", img: "/images/nguoi-lai-do.jpg", category: "Văn Học", tag: "tiengviet" },
  { title: "Đắc Nhân Tâm", price: "98000đ", img: "/images/Dac-nhan-tam.jpg", category: "Kỹ Năng", tag: "banchaythang,tiengviet" },
  { title: "Người bán hàng vĩ đại nhất", price: "86000đ", img: "/images/nguoi-ban-hang-vi-dai-nhat.jpg", category: "Kỹ Năng", tag: "tienganh" },
  { title: "Tư duy nhanh và chậm", price: "140000đ", img: "/images/tu_duy_nhanh_va_cham.jpg", category: "Kỹ Năng", tag: "tienganh" },
  { title: "Cha giàu cha nghèo", price: "99000đ", img: "/images/cha-giau-cha-ngheo.jpg", category: "Kinh Tế", tag: "tienganh" },
  { title: "Lược sử loài người", price: "150000đ", img: "/images/luoc-su.jpg", category: "Kinh Tế", tag: "tienganh" },
{ title: "Thám tử Conan tập 1", price: "30000đ", img: "/images/conan-tap-1.jpg", category: "Thiếu Nhi", tag: "moixuatban,tiengviet" },
  { title: "Bố già", price: "125000đ", img: "/images/bo-gia.jpg", category: "Văn Học", tag: "tiengviet" },
  { title: "Atomic Habits", price: "135000đ", img: "/images/automic.jpg", category: "Kỹ Năng", tag: "tienganh" },
  { title: "Think and Grow Rich", price: "99000đ", img: "/images/think.jpg", category: "Kỹ Năng", tag: "tienganh" },
  { title: "Doraemon tuyển tập đặc biệt", price: "55000đ", img: "/images/doremon.jpg", category: "Thiếu Nhi", tag: "tiengviet" },
  { title: "Hành tinh của một kẻ nghĩ nhiều", price: "89000đ", img: "/images/nghi-nhieu.jpg", category: "Văn Học", tag: "tiengviet" },
  { title: "Sherlock Holmes toàn tập", price: "199000đ", img: "/images/sl-holmes.jpg", category: "Văn Học", tag: "tienganh" },
  { title: "Chuyện con mèo dạy hải âu bay", price: "45000đ", img: "/images/meo.jpg", category: "Thiếu Nhi", tag: "tiengviet" },
  { title: "Nhà giả kim", price: "105000đ", img: "/images/nha-gia-kim.jpg", category: "Văn Học", tag: "tienganh" },
  { title: "Tuổi trẻ đáng giá bao nhiêu", price: "99000đ", img: "/images/tuoi-tre.jpg", category: "Kỹ Năng", tag: "moixuatban,tiengviet" },
  { title: "7 Thói quen để thành đạt", price: "115000đ", img: "/images/7thoiquentre.jpg", category: "Kỹ Năng", tag: "tienganh" },
  { title: "Sapiens: Lược sử loài người", price: "175000đ", img: "/images/sapiens.jpg", category: "Kinh Tế", tag: "tienganh" },
  { title: "Dạy Con Làm Giàu", price: "85000đ", img: "/images/day-con-lam-giau.jpg", category: "Nuôi Dạy Con", tag: "tiengviet" },
  { title: "Nuôi Dạy Con Kiểu Nhật", price: "99000đ", img: "/images/nuoidayconkieunhatban.jpg", category: "Nuôi Dạy Con", tag: "tiengviet" }
];

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

function filterBooks(category) {
  const filtered = books.filter(b => b.category === category);
  renderBooks(filtered);
}

function filterTag(tag) {
  const filtered = books.filter(b => (b.tag || "").split(",").includes(tag));
  renderBooks(filtered);
}

function searchBooks() {
  const keyword = document.getElementById("search-box").value.toLowerCase();
const filtered = books.filter(b => b.title.toLowerCase().includes(keyword));
  renderBooks(filtered);
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
      const priceNum = parseInt(item.price.replace("đ", ""));
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