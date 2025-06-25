import './bootstrap';
document.addEventListener("DOMContentLoaded", () => {
    // 🔍 Focus vào thanh tìm kiếm khi nhấn Ctrl+K
    document.addEventListener("keydown", (e) => {
        if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === "k") {
            e.preventDefault();
            const searchInput = document.querySelector("input[type='text']");
            if (searchInput) {
                searchInput.focus();
            }
        }
    });

    // 🛒 Tạm thời alert khi ấn "Thêm vào giỏ"
    const addToCartButtons = document.querySelectorAll("button");
    addToCartButtons.forEach((btn) => {
        if (btn.innerText.includes("Thêm vào giỏ")) {
            btn.addEventListener("click", () => {
                alert("Sách đã được thêm vào giỏ hàng 🛒");
            });
        }
    });

    // 🧹 Smooth scroll to top
    const scrollToTopBtn = document.createElement("button");
    scrollToTopBtn.innerText = "⬆️";
    scrollToTopBtn.className =
        "fixed bottom-6 right-6 bg-blue-500 text-white p-2 rounded-full shadow hover:bg-blue-600 hidden";
    document.body.appendChild(scrollToTopBtn);

    window.addEventListener("scroll", () => {
        scrollToTopBtn.style.display = window.scrollY > 300 ? "block" : "none";
    });

    scrollToTopBtn.addEventListener("click", () => {
        window.scrollTo({ top: 0, behavior: "smooth" });
    });
});