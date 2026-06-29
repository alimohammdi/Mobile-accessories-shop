document.addEventListener("DOMContentLoaded", () => {
    // Dark mode
    const themeToggle = document.getElementById("themeToggle");
    const savedTheme = localStorage.getItem("ghabos-theme");
    if (savedTheme === "dark") {
        document.body.classList.add("dark");
        if (themeToggle) themeToggle.querySelector("i").className = "ti ti-sun";
    }
    themeToggle?.addEventListener("click", () => {
        const isDark = document.body.classList.toggle("dark");
        themeToggle.querySelector("i").className = isDark
            ? "ti ti-sun"
            : "ti ti-moon";
        localStorage.setItem("ghabos-theme", isDark ? "dark" : "light");
    });

    // Mobile filter sidebar toggle
    const filterToggle = document.getElementById("filterToggle");
    const filterSidebar = document.getElementById("filterSidebar");
    const sidebarOverlay = document.getElementById("sidebarOverlay");

    filterToggle?.addEventListener("click", () => {
        filterSidebar?.classList.toggle("open");
        sidebarOverlay?.classList.toggle("open");
    });
    sidebarOverlay?.addEventListener("click", () => {
        filterSidebar?.classList.remove("open");
        sidebarOverlay?.classList.remove("open");
    });

    // Category filter
    document.querySelectorAll(".cat-filter__item").forEach((item) => {
        item.addEventListener("click", () => {
            document
                .querySelectorAll(".cat-filter__item")
                .forEach((i) => i.classList.remove("active"));
            item.classList.add("active");
        });
    });

    // Quick filter chips
    document.querySelectorAll(".quick-chip").forEach((chip) => {
        chip.addEventListener("click", () => {
            document
                .querySelectorAll(".quick-chip")
                .forEach((c) => c.classList.remove("active"));
            chip.classList.add("active");
        });
    });

    // View toggle
    const productsGrid = document.getElementById("productsGrid");
    document
        .getElementById("gridViewBtn")
        .addEventListener("click", function () {
            productsGrid.classList.remove("list-view");
            this.classList.add("active");
            document.getElementById("listViewBtn").classList.remove("active");
        });
    document
        .getElementById("listViewBtn")
        .addEventListener("click", function () {
            productsGrid.classList.add("list-view");
            this.classList.add("active");
            document.getElementById("gridViewBtn").classList.remove("active");
        });

    // Add to cart animation
    function addToCart(btn) {
        const orig = btn.innerHTML;
        btn.innerHTML = '<i class="ti ti-check"></i>';
        btn.style.background = "var(--c-green)";
        setTimeout(() => {
            btn.innerHTML = orig;
            btn.style.background = "";
        }, 900);
    }

    function resetPrice() {
        document.getElementById("priceMin").value = "۰";
        document.getElementById("priceMax").value = "۵۰,۰۰۰,۰۰۰";
        document.getElementById("priceSlider").value = 50000000;
    }

    function resetBrands() {
        document
            .querySelectorAll(".brand-check input")
            .forEach((cb) => (cb.checked = false));
    }

    // Pagination
    document.querySelectorAll(".page-btn:not(.arrow)").forEach((btn) => {
        btn.addEventListener("click", () => {
            document
                .querySelectorAll(".page-btn:not(.arrow)")
                .forEach((b) => b.classList.remove("active"));
            btn.classList.add("active");
        });
    });

    // Lazy load images
    document.querySelectorAll("img").forEach((img) => (img.loading = "lazy"));
}); // end DOMContentLoaded
