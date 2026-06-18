/**
 * ================================================================
 *  GHABOS — app.js
 *  فایل اصلی جاوااسکریپت صفحه اصلی
 *  تمام منطق UI در این فایل متمرکز شده است
 * ================================================================
 */

document.addEventListener("DOMContentLoaded", () => {
    /* ================================================================
     ۱. LAZY LOADING — بارگذاری تنبل تصاویر
     تمام تصاویر صفحه را به صورت lazy load تنظیم می‌کند
     تا سرعت بارگذاری اولیه صفحه بهتر شود
  ================================================================ */
    document.querySelectorAll("img").forEach((img) => (img.loading = "lazy"));

    /* ================================================================
     ۲. DARK MODE — حالت تاریک
     وضعیت تم را از localStorage می‌خواند و اعمال می‌کند
     با کلیک روی دکمه themeToggle بین تاریک/روشن سوئیچ می‌کند
  ================================================================ */
    document.addEventListener("DOMContentLoaded", () => {
        const themeBtn = document.getElementById("themeToggle");

        // اعمال تم ذخیره شده
        // if (localStorage.getItem("theme") === "dark") {
        //     document.body.classList.add("dark");
        // }

        if (themeBtn) {
            themeBtn.addEventListener("click", () => {
                document.body.classList.toggle("dark");

                localStorage.setItem(
                    "theme",
                    document.body.classList.contains("dark") ? "dark" : "light",
                );
            });
        }
    });

    /* ================================================================
     ۳. NEWSLETTER — فرم خبرنامه
     اعتبارسنجی ایمیل و نمایش پیام موفقیت
  ================================================================ */
    const newsletterForm = document.getElementById("newsletterForm");

    if (newsletterForm) {
        newsletterForm.addEventListener("submit", (e) => {
            e.preventDefault();
            const email = newsletterForm
                .querySelector("input[type=email]")
                .value.trim();

            // اعتبارسنجی ساده ایمیل
            if (!email || !email.includes("@")) {
                alert("ایمیل معتبر وارد کنید");
                return;
            }
            alert("عضویت با موفقیت انجام شد");
        });
    }

    /* ================================================================
     ۴. MOBILE SIDEBAR — منوی کشویی موبایل
     باز و بسته کردن sidebar با دکمه همبرگر و overlay
  ================================================================ */
    const mobileMenuBtn = document.querySelector(".mobile-menu-toggle");
    const mobileSidebar = document.getElementById("mobileSidebar");
    const sidebarClose = document.querySelector(".mobile-sidebar__close");
    const sidebarOverlay = document.querySelector(".mobile-sidebar__overlay");

    /** باز کردن sidebar */
    const openSidebar = () => mobileSidebar?.classList.add("open");
    /** بستن sidebar */
    const closeSidebar = () => mobileSidebar?.classList.remove("open");

    if (mobileMenuBtn) mobileMenuBtn.addEventListener("click", openSidebar);
    if (sidebarClose) sidebarClose.addEventListener("click", closeSidebar);
    if (sidebarOverlay) sidebarOverlay.addEventListener("click", closeSidebar);

    /* ================================================================
     ۵. MOBILE SCROLL — اسکرول افقی محصولات در موبایل
     برای گریدهای محصولات، دکمه‌های چپ/راست اضافه می‌کند
     تا در موبایل بتوان به صورت افقی اسکرول کرد
  ================================================================ */
    const scrollTargets =
        ".products-grid,.latest-products,.new-products,.brands,.cats";

    document.querySelectorAll(scrollTargets).forEach((el) => {
        // یک wrapper دور المان می‌پیچد
        const wrapper = document.createElement("div");
        wrapper.className = "mobile-scroll-wrapper";
        el.parentNode.insertBefore(wrapper, el);
        wrapper.appendChild(el);

        // دکمه اسکرول به راست (قبلی در RTL)
        const prev = document.createElement("button");
        prev.className = "scroll-arrow prev";
        prev.innerHTML = "❯";

        // دکمه اسکرول به چپ (بعدی در RTL)
        const next = document.createElement("button");
        next.className = "scroll-arrow next";
        next.innerHTML = "❮";

        wrapper.appendChild(prev);
        wrapper.appendChild(next);

        prev.addEventListener("click", () =>
            el.scrollBy({ left: -250, behavior: "smooth" }),
        );
        next.addEventListener("click", () =>
            el.scrollBy({ left: 250, behavior: "smooth" }),
        );
    });

    /* ================================================================
     ۶. MEGA MENU — منوی دسته‌بندی‌ها
     باز/بسته کردن mega menu با کلیک روی دکمه «همه دسته‌بندی‌ها»
     و hover روی آیتم‌های sidebar برای نمایش زیردسته‌ها
  ================================================================ */
    const megaToggleBtn = document.querySelector(".nav__cats");
    const megaMenu = document.getElementById("megaMenu");
    const megaOverlay = document.getElementById("megaOverlay");

    if (megaToggleBtn && megaMenu) {
        megaToggleBtn.addEventListener("click", () => {
            megaMenu.classList.toggle("open");
            megaOverlay?.classList.toggle("open");
        });
    }

    // بستن mega menu با کلیک روی overlay تاریک پشت آن
    if (megaOverlay) {
        megaOverlay.addEventListener("click", () => {
            megaMenu?.classList.remove("open");
            megaOverlay.classList.remove("open");
        });
    }

    // فعال کردن آیتم sidebar با hover (نمایش زیردسته‌ها)
    document.querySelectorAll(".mega-sidebar a").forEach((item) => {
        item.addEventListener("mouseenter", () => {
            document
                .querySelectorAll(".mega-sidebar a")
                .forEach((x) => x.classList.remove("active"));
            item.classList.add("active");
        });
    });

    /* ================================================================
     ۷. WISHLIST (FAV) BUTTONS — دکمه‌های علاقه‌مندی روی کارت محصول
     ----------------------------------------------------------------
     مشکل اصلی: کارت‌های محصول دارای onclick روی خود div هستند که
     باعث می‌شود کلیک روی دکمه fav هم صفحه را عوض کند (event bubbling)
     راه‌حل: در handler دکمه fav، از stopPropagation استفاده می‌کنیم
     تا رویداد به کارت پدر نرسد.

     همچنین اطلاعات محصول از data-attributes کارت خوانده می‌شود
     و به آرایه wishItems اضافه می‌گردد.
  ================================================================ */

    /**
     * خواندن اطلاعات محصول از data-attributes کارت
     * @param {HTMLElement} card - المان .product-card
     * @returns {Object} اطلاعات محصول
     */
    function getProductFromCard(card) {
        return {
            id: card.dataset.id,
            title: card.dataset.title,
            cat: card.dataset.cat,
            price: parseInt(card.dataset.price, 10),
            img: card.dataset.img,
        };
    }

    // اتصال رویداد به تمام دکمه‌های علاقه‌مندی
    document.querySelectorAll(".product-card__fav").forEach((btn) => {
        btn.addEventListener("click", (e) => {
            /**
             * جلوگیری از bubble شدن رویداد به کارت پدر
             * بدون این خط، کلیک روی fav باعث می‌شد onclick کارت هم اجرا شود
             * و کاربر به صفحه محصول منتقل شود
             */
            e.stopPropagation();

            const card = btn.closest(".product-card");
            if (!card) return;

            const product = getProductFromCard(card);
            const icon = btn.querySelector("i");

            // بررسی اینکه آیا قبلاً اضافه شده یا نه
            const alreadyInWish = wishItems.some((i) => i.id === product.id);

            if (alreadyInWish) {
                // اگر قبلاً اضافه شده، از لیست حذف می‌کنیم (toggle)
                wishItems = wishItems.filter((i) => i.id !== product.id);
                btn.classList.remove("active");
                if (icon) icon.className = "ti ti-heart";
            } else {
                // اضافه کردن به علاقه‌مندی‌ها — آیکون به حالت پر و قرمز تغییر می‌کند
                wishItems.push(product);
                btn.classList.add("active");
                if (icon) icon.className = "ti ti-heart-filled";
            }

            // آپدیت badge شماره علاقه‌مندی‌ها در header
            const wishBadge = document.getElementById("wishlistBadge");
            if (wishBadge) wishBadge.textContent = fa(wishItems.length);
        });
    });

    /* ================================================================
     ۸. CART & WISHLIST MODAL — پنل سبد خرید و علاقه‌مندی‌ها
     ----------------------------------------------------------------
     دو پنل کشویی از سمت چپ:
     - سبد خرید: نمایش محصولات، تغییر تعداد، حذف، جمع کل
     - علاقه‌مندی‌ها: نمایش محصولات، حذف، افزودن به سبد
  ================================================================ */
    (function () {
        /* --- داده‌های نمونه سبد خرید (در پروژه واقعی از API می‌آید) --- */
        let cartItems = [
            {
                id: "p1",
                title: "کابل شارژ سریع تایپ-سی انکر مدل PowerLine",
                cat: "شارژر و کابل",
                price: 224000,
                oldPrice: 280000,
                qty: 1,
                img: "https://images.unsplash.com/photo-1583863788434-e58a36330cf0?q=80&w=120&auto=format&fit=crop",
            },
            {
                id: "p5",
                title: "ساعت هوشمند سامسونگ گلکسی واچ ۶",
                cat: "ساعت هوشمند",
                price: 3150000,
                oldPrice: 4500000,
                qty: 1,
                img: "https://images.unsplash.com/photo-1546868871-7041f2a55e12?q=80&w=120&auto=format&fit=crop",
            },
        ];

        /* --- داده‌های نمونه علاقه‌مندی‌ها (با wishItems بیرون sync می‌شود) --- */
        // این متغیر در scope بیرونی (DOMContentLoaded) تعریف شده
        // تا دکمه‌های fav کارت‌ها هم به آن دسترسی داشته باشند

        /* --- توابع کمکی تبدیل عدد به فارسی --- */

        /**
         * تبدیل ارقام انگلیسی به فارسی
         * @param {number|string} n
         * @returns {string}
         */
        const fa = (n) => String(n).replace(/\d/g, (d) => "۰۱۲۳۴۵۶۷۸۹"[d]);

        /**
         * فرمت عدد با جداکننده هزارتایی و تبدیل به فارسی
         * @param {number} n
         * @returns {string}
         */
        const fmt = (n) => fa(n.toLocaleString("fa-IR"));

        /* --- باز و بسته کردن modal --- */

        /**
         * باز کردن یک modal و overlay آن
         * اسکرول صفحه را هم قفل می‌کند
         */
        function openModal(modal, overlay) {
            modal.classList.add("open");
            overlay.classList.add("open");
            document.body.style.overflow = "hidden"; // جلوگیری از اسکرول پس‌زمینه
        }

        /**
         * بستن modal و آزاد کردن اسکرول صفحه
         */
        function closeModal(modal, overlay) {
            modal.classList.remove("open");
            overlay.classList.remove("open");
            document.body.style.overflow = "";
        }

        /* --- رندر سبد خرید --- */

        /**
         * محتوای modal سبد خرید را بر اساس آرایه cartItems رندر می‌کند
         * شامل: لیست محصولات، دکمه‌های +/−، حذف، و جمع کل
         */
        function renderCart() {
            const body = document.getElementById("cartBody");
            const totalEl = document.getElementById("cartTotal");
            const badge = document.getElementById("cartBadge");
            if (!body) return;

            // آپدیت badge تعداد کل آیتم‌ها
            const totalQty = cartItems.reduce((sum, item) => sum + item.qty, 0);
            badge.textContent = fa(totalQty);

            // حالت خالی بودن سبد
            if (!cartItems.length) {
                body.innerHTML = `<div class="gm-empty"><i class="ti ti-shopping-bag"></i><p>سبد خرید شما خالی است</p></div>`;
                totalEl.innerHTML = "";
                return;
            }

            // محاسبه جمع کل
            const total = cartItems.reduce(
                (sum, item) => sum + item.price * item.qty,
                0,
            );
            totalEl.innerHTML = `<span>جمع کل:</span><strong>${fmt(total)} تومان</strong>`;

            // رندر HTML آیتم‌ها
            body.innerHTML = cartItems
                .map(
                    (item) => `
        <div class="gm-item" data-id="${item.id}">
          <img class="gm-item__img" src="${item.img}" alt="${item.title}" loading="lazy">
          <div class="gm-item__info">
            <span class="gm-item__cat">${item.cat}</span>
            <p class="gm-item__title">${item.title}</p>
            <div class="gm-item__meta">
              <div class="gm-item__qty">
                <button class="gm-qty-btn" data-action="dec" data-id="${item.id}"><i class="ti ti-minus"></i></button>
                <span>${fa(item.qty)}</span>
                <button class="gm-qty-btn" data-action="inc" data-id="${item.id}"><i class="ti ti-plus"></i></button>
              </div>
              <div class="gm-item__prices">
                ${item.oldPrice ? `<span class="gm-item__old">${fmt(item.oldPrice)}</span>` : ""}
                <span class="gm-item__new">${fmt(item.price)} <small>تومان</small></span>
              </div>
            </div>
          </div>
          <button class="gm-item__del" data-id="${item.id}" aria-label="حذف"><i class="ti ti-trash"></i></button>
        </div>
      `,
                )
                .join("");

            // اتصال رویداد دکمه حذف
            body.querySelectorAll(".gm-item__del").forEach((btn) => {
                btn.addEventListener("click", () => {
                    cartItems = cartItems.filter(
                        (i) => i.id !== btn.dataset.id,
                    );
                    renderCart();
                });
            });

            // اتصال رویداد دکمه‌های افزایش/کاهش تعداد
            body.querySelectorAll(".gm-qty-btn").forEach((btn) => {
                btn.addEventListener("click", () => {
                    const item = cartItems.find((i) => i.id === btn.dataset.id);
                    if (!item) return;

                    if (btn.dataset.action === "inc") {
                        item.qty++; // افزایش تعداد
                    } else if (item.qty > 1) {
                        item.qty--; // کاهش تعداد
                    } else {
                        cartItems = cartItems.filter((i) => i.id !== item.id); // حذف اگر تعداد به صفر برسد
                    }
                    renderCart();
                });
            });
        }

        /* --- رندر علاقه‌مندی‌ها --- */

        /**
         * محتوای modal علاقه‌مندی‌ها را بر اساس آرایه wishItems رندر می‌کند
         * شامل: لیست محصولات، دکمه حذف، و دکمه افزودن به سبد
         */
        function renderWishlist() {
            const body = document.getElementById("wishlistBody");
            const badge = document.getElementById("wishlistBadge");
            if (!body) return;

            badge.textContent = fa(wishItems.length);

            // حالت خالی بودن لیست
            if (!wishItems.length) {
                body.innerHTML = `<div class="gm-empty"><i class="ti ti-heart"></i><p>لیست علاقه‌مندی‌ها خالی است</p></div>`;
                return;
            }

            // رندر HTML آیتم‌ها
            body.innerHTML = wishItems
                .map(
                    (item) => `
        <div class="gm-item" data-id="${item.id}">
          <img class="gm-item__img" src="${item.img}" alt="${item.title}" loading="lazy">
          <div class="gm-item__info">
            <span class="gm-item__cat">${item.cat}</span>
            <p class="gm-item__title">${item.title}</p>
            <div class="gm-item__meta">
              <span class="gm-item__new">${fmt(item.price)} <small>تومان</small></span>
              <button class="gm-add-cart-btn" data-id="${item.id}">
                <i class="ti ti-shopping-cart-plus"></i> افزودن به سبد
              </button>
            </div>
          </div>
          <button class="gm-item__del" data-id="${item.id}" aria-label="حذف"><i class="ti ti-trash"></i></button>
        </div>
      `,
                )
                .join("");

            // اتصال رویداد دکمه حذف از علاقه‌مندی
            body.querySelectorAll(".gm-item__del").forEach((btn) => {
                btn.addEventListener("click", () => {
                    wishItems = wishItems.filter(
                        (i) => i.id !== btn.dataset.id,
                    );
                    // آپدیت ظاهر دکمه fav روی کارت محصول مربوطه (برگشت به حالت خط‌دار)
                    const favBtn = document.querySelector(
                        `.product-card[data-id="${btn.dataset.id}"] .product-card__fav`,
                    );
                    if (favBtn) {
                        favBtn.classList.remove("active");
                        const favIcon = favBtn.querySelector("i");
                        if (favIcon) favIcon.className = "ti ti-heart";
                    }
                    renderWishlist();
                });
            });

            // اتصال رویداد دکمه «افزودن به سبد» از علاقه‌مندی
            body.querySelectorAll(".gm-add-cart-btn").forEach((btn) => {
                btn.addEventListener("click", () => {
                    const item = wishItems.find((i) => i.id === btn.dataset.id);
                    if (!item) return;

                    // اگر قبلاً در سبد هست فقط تعداد اضافه می‌کند، وگرنه آیتم جدید اضافه می‌کند
                    const existing = cartItems.find((i) => i.id === item.id);
                    if (existing) {
                        existing.qty++;
                    } else {
                        cartItems.push({ ...item, qty: 1 });
                    }

                    // حذف از علاقه‌مندی بعد از افزودن به سبد
                    wishItems = wishItems.filter((i) => i.id !== item.id);
                    const favBtn = document.querySelector(
                        `.product-card[data-id="${item.id}"] .product-card__fav`,
                    );
                    if (favBtn) {
                        favBtn.classList.remove("active");
                        const favIcon = favBtn.querySelector("i");
                        if (favIcon) favIcon.className = "ti ti-heart";
                    }

                    renderWishlist();
                    renderCart();
                });
            });
        }

        /* --- المان‌های DOM برای modal ها --- */
        const cartModal = document.getElementById("cartModal");
        const cartOverlay = document.getElementById("cartOverlay");
        const wishModal = document.getElementById("wishlistModal");
        const wishOverlay = document.getElementById("wishlistOverlay");

        /* --- اتصال رویدادها به دکمه‌های header --- */

        // دکمه سبد خرید در header
        document.getElementById("cartBtn")?.addEventListener("click", () => {
            renderCart();
            openModal(cartModal, cartOverlay);
        });
        document
            .getElementById("cartClose")
            ?.addEventListener("click", () =>
                closeModal(cartModal, cartOverlay),
            );
        cartOverlay?.addEventListener("click", () =>
            closeModal(cartModal, cartOverlay),
        );

        // دکمه علاقه‌مندی‌ها در header
        document
            .getElementById("wishlistBtn")
            ?.addEventListener("click", () => {
                renderWishlist();
                openModal(wishModal, wishOverlay);
            });
        document
            .getElementById("wishlistClose")
            ?.addEventListener("click", () =>
                closeModal(wishModal, wishOverlay),
            );
        wishOverlay?.addEventListener("click", () =>
            closeModal(wishModal, wishOverlay),
        );

        // بستن هر دو modal با کلید Escape
        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") {
                closeModal(cartModal, cartOverlay);
                closeModal(wishModal, wishOverlay);
            }
        });
    })(); // end IIFE modal
}); // end DOMContentLoaded

/* ================================================================
   متغیر سراسری wishItems
   خارج از DOMContentLoaded تعریف شده تا هم دکمه‌های fav کارت‌ها
   و هم IIFE modal بتوانند به آن دسترسی داشته باشند
================================================================ */
/**
 * آرایه محصولات علاقه‌مندی — در طول session در حافظه نگه داشته می‌شود
 * @type {Array<{id:string, title:string, cat:string, price:number, img:string}>}
 */
var wishItems = [];

/**
 * تبدیل ارقام انگلیسی به فارسی (نسخه global برای badge های خارج از modal)
 * @param {number|string} n
 * @returns {string}
 */
function fa(n) {
    return String(n).replace(/\d/g, (d) => "۰۱۲۳۴۵۶۷۸۹"[d]);
}

/* Extracted from cart.html */

/* ================================================================
       CART PAGE LOGIC
       - مستقل از app.js اجرا می‌شود
       - داده‌های مشابه داده‌های modal از app.js برای نمایش یکسان
    ================================================================ */
document.addEventListener("DOMContentLoaded", function () {
    /* ---  helpers --- */
    const fa = (n) => String(n).replace(/\d/g, (d) => "۰۱۲۳۴۵۶۷۸۹"[d]);
    const fmt = (n) => fa(n.toLocaleString("fa-IR"));

    /* --- داده‌های محصولات سبد (هم‌راستا با app.js) --- */
    let pageCartItems = [
        {
            id: "p1",
            title: "کابل شارژ سریع تایپ-سی انکر مدل PowerLine III",
            cat: "شارژر و کابل",
            price: 224000,
            oldPrice: 280000,
            qty: 1,
            stock: 15,
            guarantee: "گارانتی ۶ ماهه",
            badge: null,
            img: "https://images.unsplash.com/photo-1583863788434-e58a36330cf0?q=80&w=200&auto=format&fit=crop",
        },
        {
            id: "p5",
            title: "ساعت هوشمند سامسونگ گلکسی واچ ۶ نقره‌ای ۴۴mm",
            cat: "ساعت هوشمند",
            price: 3150000,
            oldPrice: 4500000,
            qty: 1,
            stock: 3,
            guarantee: "گارانتی ۱۸ ماهه",
            badge: "موجودی محدود",
            img: "https://images.unsplash.com/photo-1546868871-7041f2a55e12?q=80&w=200&auto=format&fit=crop",
        },
        {
            id: "p9",
            title: "هدفون بی‌سیم سونی WH-1000XM5 مشکی",
            cat: "هندزفری و اسپیکر",
            price: 3450000,
            oldPrice: 3826000,
            qty: 1,
            stock: 7,
            guarantee: "گارانتی ۱۲ ماهه",
            badge: null,
            img: "https://images.unsplash.com/photo-1505740420928-5e560c06d30e?q=80&w=200&auto=format&fit=crop",
        },
    ];

    /* --- محصولات پیشنهادی --- */
    const suggested = [
        {
            id: "s1",
            title: "پاوربانک انکر ۲۰۰۰۰ مگاپاور",
            cat: "پاوربانک",
            price: 890000,
            oldPrice: 1100000,
            img: "https://images.unsplash.com/photo-1609091839311-d5365f9ff1c5?q=80&w=300&auto=format&fit=crop",
            rating: 4.7,
            reviews: 284,
        },
        {
            id: "s2",
            title: "کیس شفاف مگ‌سیف آیفون ۱۵ پرو",
            cat: "قاب و محافظ",
            price: 145000,
            oldPrice: 190000,
            img: "https://images.unsplash.com/photo-1601784551446-20c9e07cdbdb?q=80&w=300&auto=format&fit=crop",
            rating: 4.5,
            reviews: 128,
        },
        {
            id: "s3",
            title: "شارژر دیواری ۶۵ وات گرین لاین",
            cat: "شارژر و کابل",
            price: 310000,
            oldPrice: 380000,
            img: "https://images.unsplash.com/photo-1585771724684-38269d6639fd?q=80&w=300&auto=format&fit=crop",
            rating: 4.8,
            reviews: 412,
        },
        {
            id: "s4",
            title: "گلس سرامیکی حریم خصوصی ۹D",
            cat: "محافظ صفحه",
            price: 85000,
            oldPrice: 120000,
            img: "https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?q=80&w=300&auto=format&fit=crop",
            rating: 4.3,
            reviews: 97,
        },
    ];

    /* کد تخفیف */
    const COUPONS = { WINTER2026: 10, GHABOS10: 10, WELCOME: 5 };
    let appliedCoupon = null;

    /* ---- رندر آیتم‌های سبد در صفحه ---- */
    function renderPageCart() {
        const list = document.getElementById("cartItemsList");
        const countEl = document.getElementById("pageCartCount");
        const summaryQty = document.getElementById("summaryQty");
        const summaryOriginal = document.getElementById("summaryOriginal");
        const summaryDiscount = document.getElementById("summaryDiscount");
        const summaryTotal = document.getElementById("summaryTotal");
        const summaryCoupon = document.getElementById("summaryCoupon");
        const couponRow = document.getElementById("couponRow");
        const shippingMsg = document.getElementById("shippingMsg");
        const shippingBar = document.getElementById("shippingBar");
        const badge = document.getElementById("cartBadge");
        const mobileBadge = document.querySelector(".bottom-nav .badge");

        const totalQty = pageCartItems.reduce((s, i) => s + i.qty, 0);
        if (countEl) countEl.textContent = fa(totalQty) + " محصول";
        if (summaryQty) summaryQty.textContent = fa(totalQty);
        if (badge) badge.textContent = fa(totalQty);
        if (mobileBadge) mobileBadge.textContent = fa(totalQty);

        if (!list) return;

        if (!pageCartItems.length) {
            // نمایش سبد خالی — حالت کامل
            if (countEl) countEl.textContent = "خالی";
            document.getElementById("cartLayout").innerHTML = `
            <div class="cart-empty-wrap">
              <div class="cart-empty">
                <div class="cart-empty__icon-wrap">
                  <div class="cart-empty__dot"></div>
                  <div class="cart-empty__dot"></div>
                  <div class="cart-empty__dot"></div>
                  <div class="cart-empty__icon-bg">
                    <i class="ti ti-shopping-bag"></i>
                  </div>
                </div>
                <h3>سبد خرید شما خالی است</h3>
                <p>هنوز هیچ محصولی به سبد خریدتان اضافه نکرده‌اید.<br>همین حالا خرید را شروع کنید و از تخفیف‌های ویژه بهره‌مند شوید!</p>
                <div class="cart-empty__actions">
                  <a href="index.html" class="cart-empty__btn">
                    <i class="ti ti-shopping"></i> رفتن به فروشگاه
                  </a>
                  <a href="wishlist.html" class="cart-empty__btn--outline">
                    <i class="ti ti-heart"></i> علاقه‌مندی‌ها
                  </a>
                </div>
                <div class="cart-empty__perks">
                  <div class="cart-empty__perk">
                    <i class="ti ti-truck-delivery"></i>
                    <span>ارسال رایگان<br>بالای ۵ میلیون</span>
                  </div>
                  <div class="cart-empty__perk">
                    <i class="ti ti-shield-check"></i>
                    <span>پرداخت<br>۱۰۰٪ امن</span>
                  </div>
                  <div class="cart-empty__perk">
                    <i class="ti ti-refresh"></i>
                    <span>۷ روز ضمانت<br>بازگشت وجه</span>
                  </div>
                  <div class="cart-empty__perk">
                    <i class="ti ti-certificate"></i>
                    <span>گارانتی<br>اصالت کالا</span>
                  </div>
                </div>
              </div>
            </div>`;
            return;
        }

        /* رندر آیتم‌ها */
        list.innerHTML = pageCartItems
            .map((item) => {
                const discPct = item.oldPrice
                    ? Math.round((1 - item.price / item.oldPrice) * 100)
                    : 0;
                return `
          <div class="cart-item" data-id="${item.id}">
            <img class="cart-item__img" src="${item.img}" alt="${item.title}" loading="lazy" />
            <div class="cart-item__body">
              <span class="cart-item__cat">${item.cat}</span>
              <p class="cart-item__title">
                <a href="product.html?id=${item.id}">${item.title}</a>
              </p>
              <div class="cart-item__attrs">
                ${item.badge ? `<span class="cart-item__badge">${item.badge}</span>` : ""}
                <span class="cart-item__badge green"><i class="ti ti-shield-check" style="font-size:11px"></i> ${item.guarantee}</span>
                ${item.stock <= 5 ? `<span class="cart-item__badge" style="color:var(--c-amber);border-color:rgba(245,166,35,.3);background:rgba(245,166,35,.08)">فقط ${fa(item.stock)} عدد باقی‌مانده</span>` : ""}
              </div>
              <div class="cart-item__meta">
                <div class="cart-item__qty">
                  <button class="qty-btn dec" data-id="${item.id}" aria-label="کاهش">
                    <i class="ti ti-minus"></i>
                  </button>
                  <span class="qty-val">${fa(item.qty)}</span>
                  <button class="qty-btn inc" data-id="${item.id}" aria-label="افزایش">
                    <i class="ti ti-plus"></i>
                  </button>
                </div>
                <div class="cart-item__prices">
                  ${item.oldPrice ? `<span class="cart-item__old">${fmt(item.oldPrice)} تومان</span>` : ""}
                  <span class="cart-item__new">${fmt(item.price)} <small>تومان</small></span>
                  ${discPct ? `<span class="cart-item__disc">${fa(discPct)}٪ تخفیف</span>` : ""}
                </div>
              </div>
            </div>
            <button class="cart-item__del" data-id="${item.id}" aria-label="حذف از سبد">
              <i class="ti ti-trash"></i>
            </button>
          </div>`;
            })
            .join("");

        /* اتصال رویداد حذف */
        list.querySelectorAll(".cart-item__del").forEach((btn) => {
            btn.addEventListener("click", () => {
                pageCartItems = pageCartItems.filter(
                    (i) => i.id !== btn.dataset.id,
                );
                renderPageCart();
            });
        });

        /* اتصال رویداد +/- */
        list.querySelectorAll(".qty-btn").forEach((btn) => {
            btn.addEventListener("click", () => {
                const item = pageCartItems.find((i) => i.id === btn.dataset.id);
                if (!item) return;
                if (btn.classList.contains("inc")) {
                    item.qty++;
                } else if (item.qty > 1) {
                    item.qty--;
                } else {
                    pageCartItems = pageCartItems.filter(
                        (i) => i.id !== item.id,
                    );
                }
                renderPageCart();
            });
        });

        /* محاسبه اعداد خلاصه */
        const origTotal = pageCartItems.reduce(
            (s, i) => s + (i.oldPrice || i.price) * i.qty,
            0,
        );
        const discTotal = pageCartItems.reduce(
            (s, i) => s + i.price * i.qty,
            0,
        );
        const saved = origTotal - discTotal;
        const FREE_SHIP_THRESHOLD = 5000000;
        let couponAmt = 0;

        if (appliedCoupon && COUPONS[appliedCoupon]) {
            couponAmt = Math.round((discTotal * COUPONS[appliedCoupon]) / 100);
            couponRow.style.display = "flex";
            summaryCoupon.textContent = "−" + fmt(couponAmt) + " تومان";
        } else {
            couponRow.style.display = "none";
        }

        const finalTotal = discTotal - couponAmt;
        const remaining = FREE_SHIP_THRESHOLD - finalTotal;
        const progress = Math.min(
            100,
            Math.round((finalTotal / FREE_SHIP_THRESHOLD) * 100),
        );

        if (summaryOriginal)
            summaryOriginal.textContent = fmt(origTotal) + " تومان";
        if (summaryDiscount)
            summaryDiscount.textContent = "−" + fmt(saved) + " تومان";
        if (summaryTotal)
            summaryTotal.innerHTML = fmt(finalTotal) + " <small>تومان</small>";

        /* پیام ارسال رایگان */
        if (remaining <= 0) {
            if (shippingMsg)
                shippingMsg.textContent = "🎉 ارسال این سفارش رایگان است!";
            if (shippingBar) shippingBar.style.width = "100%";
            if (document.getElementById("summaryShipping"))
                document.getElementById("summaryShipping").textContent =
                    "رایگان";
        } else {
            if (shippingMsg)
                shippingMsg.textContent =
                    "برای ارسال رایگان " +
                    fmt(remaining) +
                    " تومان دیگر خرید کنید";
            if (shippingBar) shippingBar.style.width = progress + "%";
            if (document.getElementById("summaryShipping"))
                document.getElementById("summaryShipping").innerHTML =
                    '<span style="font-size:12px;color:var(--c-muted)">محاسبه در مرحله بعد</span>';
        }
    }

    /* ---- پاک کردن همه ---- */
    document.getElementById("clearCartBtn")?.addEventListener("click", () => {
        if (confirm("آیا می‌خواهید همه محصولات را از سبد خرید حذف کنید؟")) {
            pageCartItems = [];
            renderPageCart();
        }
    });

    /* ---- اعمال کد تخفیف ---- */
    const couponBtn = document.getElementById("applyCoupon");
    const couponInput = document.getElementById("couponInput");

    couponBtn?.addEventListener("click", () => {
        const code = couponInput.value.trim().toUpperCase();
        if (!code) return;

        if (appliedCoupon === code) {
            showCouponMsg("این کد قبلاً اعمال شده است.", "amber");
            return;
        }

        if (COUPONS[code]) {
            appliedCoupon = code;
            couponBtn.classList.add("applied");
            couponBtn.innerHTML = '<i class="ti ti-check"></i> اعمال شد';
            showCouponMsg(
                "کد تخفیف " + fa(COUPONS[code]) + "٪ با موفقیت اعمال شد!",
                "green",
            );
            renderPageCart();
        } else {
            showCouponMsg("کد تخفیف نامعتبر است.", "red");
        }
    });

    function showCouponMsg(msg, type) {
        let el = document.getElementById("couponMsg");
        if (!el) {
            el = document.createElement("div");
            el.id = "couponMsg";
            el.style.cssText =
                "font-size:12px;font-weight:600;padding:6px 10px;border-radius:8px;margin-top:-6px;transition:opacity .3s";
            couponInput.parentElement.after(el);
        }
        const colors = {
            green: "var(--c-green)",
            red: "var(--c-red)",
            amber: "var(--c-amber)",
        };
        el.style.color = colors[type] || "var(--c-muted)";
        el.textContent = msg;
        setTimeout(() => {
            el.style.opacity = "0";
        }, 3000);
        setTimeout(() => {
            el.style.opacity = "1";
        }, 0);
    }

    /* ---- رندر محصولات پیشنهادی ---- */
    function renderSuggested() {
        const grid = document.getElementById("suggestGrid");
        if (!grid) return;
        grid.innerHTML = suggested
            .map((p) => {
                const discPct = Math.round((1 - p.price / p.oldPrice) * 100);
                const stars = Math.round(p.rating);
                return `
          <a href="product.html?id=${p.id}" class="product-card">
            <div class="product-card__media">
              <img src="${p.img}" alt="${p.title}" loading="lazy" />
              <span class="product-card__badge">${fa(discPct)}٪</span>
              <button class="product-card__fav" aria-label="افزودن به علاقه‌مندی">
                <i class="ti ti-heart"></i>
              </button>
            </div>
            <div class="product-card__body">
              <span class="product-card__cat">${p.cat}</span>
              <h3 class="product-card__title">${p.title}</h3>
              <div class="product-card__rating">
                ${'<i class="ti ti-star-filled" style="color:var(--c-amber);font-size:12px"></i>'.repeat(stars)}
                <span style="font-size:12px;color:var(--c-muted)">(${fmt(p.reviews)})</span>
              </div>
              <div class="product-card__prices">
                <span class="product-card__old">${fmt(p.oldPrice)}</span>
                <span class="product-card__new">${fmt(p.price)} <small>تومان</small></span>
              </div>
            </div>
          </a>`;
            })
            .join("");
    }

    /* ---- اجرا ---- */
    renderPageCart();
    renderSuggested();

    /* ---- dark mode toggle (هم‌راستا با app.js) ---- */
    const themeToggle = document.getElementById("themeToggle");
    const saved = localStorage.getItem("ghabos-theme");
    if (saved === "dark") {
        document.body.classList.add("dark");
        themeToggle && (themeToggle.querySelector("i").className = "ti ti-sun");
    }
    themeToggle?.addEventListener("click", () => {
        const isDark = document.body.classList.toggle("dark");
        themeToggle.querySelector("i").className = isDark
            ? "ti ti-sun"
            : "ti ti-moon";
        localStorage.setItem("ghabos-theme", isDark ? "dark" : "light");
    });
});
