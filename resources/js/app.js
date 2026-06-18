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
    const themeBtn = document.getElementById("themeToggle");

    // اعمال تم ذخیره‌شده از جلسه قبل
    if (localStorage.getItem("theme") === "dark") {
        document.body.classList.add("dark");
    }

    if (themeBtn) {
        themeBtn.addEventListener("click", () => {
            document.body.classList.toggle("dark");
            // ذخیره وضعیت جدید در localStorage
            localStorage.setItem(
                "theme",
                document.body.classList.contains("dark") ? "dark" : "light",
            );
        });
    }

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

            // بررسی اینکه آیا قبلاً اضافه شده یا نه
            const alreadyInWish = wishItems.some((i) => i.id === product.id);

            if (alreadyInWish) {
                // اگر قبلاً اضافه شده، از لیست حذف می‌کنیم (toggle)
                wishItems = wishItems.filter((i) => i.id !== product.id);
                btn.classList.remove("active");
                btn.style.color = "";
            } else {
                // اضافه کردن به علاقه‌مندی‌ها
                wishItems.push(product);
                btn.classList.add("active");
                btn.style.color = "var(--c-red)"; // قلب قرمز برای نشان دادن انتخاب
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
                    // آپدیت ظاهر دکمه fav روی کارت محصول مربوطه
                    const favBtn = document.querySelector(
                        `.product-card[data-id="${btn.dataset.id}"] .product-card__fav`,
                    );
                    if (favBtn) {
                        favBtn.classList.remove("active");
                        favBtn.style.color = "";
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
                        favBtn.style.color = "";
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
