/**
 * ================================================================
 *  GHABOS — ghabos.js
 *  فایل اصلی یکپارچه جاوااسکریپت
 *  ادغام app.js + login.js بدون کد تکراری
 *
 *  ساختار:
 *   0. UTILS         — توابع کمکی مشترک (fa, fmt, toPersian)
 *   1. DARK MODE     — یک پیاده‌سازی واحد
 *   2. LAZY LOAD     — بارگذاری تنبل تصاویر
 *   3. MEGA MENU     — منوی دسته‌بندی‌ها
 *   4. MOBILE SIDEBAR — منوی کشویی موبایل
 *   5. WISHLIST      — دکمه‌های علاقه‌مندی کارت محصول
 *   6. CART & WISH MODAL — پنل‌های کشویی header
 *   7. CART PAGE     — صفحه سبد خرید
 *   8. LOGIN / OTP   — فرم ورود، ثبت‌نام، کد تأیید
 *   9. NEWSLETTER    — فرم خبرنامه
 *  10. MOBILE SCROLL — اسکرول افقی گریدهای موبایل
 * ================================================================
 */

/* ================================================================
   0. UTILS — توابع کمکی مشترک (یک بار تعریف، همه‌جا استفاده)
================================================================ */

/**
 * تبدیل ارقام انگلیسی به فارسی
 * @param {number|string} n
 * @returns {string}
 */
function fa(n) {
    return String(n).replace(/\d/g, (d) => "۰۱۲۳۴۵۶۷۸۹"[d]);
}

/**
 * فرمت عدد با جداکننده هزارتایی + تبدیل به فارسی
 * @param {number} n
 * @returns {string}
 */
function fmt(n) {
    return fa(n.toLocaleString("fa-IR"));
}

/* ================================================================
   متغیرهای سراسری
================================================================ */

/** آرایه محصولات علاقه‌مندی — در طول session در حافظه نگه داشته می‌شود */
var wishItems = [];

/* ================================================================
   راه‌انداز اصلی — اجرا پس از بارگذاری DOM
================================================================ */
document.addEventListener("DOMContentLoaded", () => {
    /* ================================================================
       1. DARK MODE
       یک پیاده‌سازی واحد — localStorage key: "ghabos-theme"
    ================================================================ */
    const themeBtn = document.getElementById("themeToggle");

    /** اعمال تم ذخیره‌شده هنگام بارگذاری صفحه */
    if (localStorage.getItem("ghabos-theme") === "dark") {
        document.body.classList.add("dark");
        if (themeBtn) {
            themeBtn.querySelector("i").className = "ti ti-sun";
        }
    }

    if (themeBtn) {
        themeBtn.addEventListener("click", () => {
            const isDark = document.body.classList.toggle("dark");
            themeBtn.querySelector("i").className = isDark
                ? "ti ti-sun"
                : "ti ti-moon";
            localStorage.setItem("ghabos-theme", isDark ? "dark" : "light");
        });
    }

    /* ================================================================
       2. LAZY LOAD — بارگذاری تنبل تصاویر
    ================================================================ */
    document.querySelectorAll("img").forEach((img) => (img.loading = "lazy"));

    /* ================================================================
       3. MEGA MENU — منوی دسته‌بندی‌ها
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

    if (megaOverlay) {
        megaOverlay.addEventListener("click", () => {
            megaMenu?.classList.remove("open");
            megaOverlay.classList.remove("open");
        });
    }

    /** فعال‌سازی زیردسته با hover روی sidebar مگامنو */
    document.querySelectorAll(".mega-sidebar a").forEach((item) => {
        item.addEventListener("mouseenter", () => {
            document
                .querySelectorAll(".mega-sidebar a")
                .forEach((x) => x.classList.remove("active"));
            item.classList.add("active");
        });
    });

    /* ================================================================
       4. MOBILE SIDEBAR — منوی کشویی موبایل
    ================================================================ */
    const mobileMenuBtn = document.querySelector(".mobile-menu-toggle");
    const mobileSidebar = document.getElementById("mobileSidebar");
    const sidebarClose = document.querySelector(".mobile-sidebar__close");
    const sidebarOverlay = document.querySelector(".mobile-sidebar__overlay");

    const openSidebar = () => mobileSidebar?.classList.add("open");
    const closeSidebar = () => mobileSidebar?.classList.remove("open");

    if (mobileMenuBtn) mobileMenuBtn.addEventListener("click", openSidebar);
    if (sidebarClose) sidebarClose.addEventListener("click", closeSidebar);
    if (sidebarOverlay) sidebarOverlay.addEventListener("click", closeSidebar);

    /* ================================================================
       5. WISHLIST (FAV) BUTTONS — دکمه‌های علاقه‌مندی روی کارت محصول
    ================================================================ */

    /**
     * خواندن اطلاعات محصول از data-attributes کارت
     * @param {HTMLElement} card - المان .product-card
     * @returns {Object}
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

    document.querySelectorAll(".product-card__fav").forEach((btn) => {
        btn.addEventListener("click", (e) => {
            e.stopPropagation(); // جلوگیری از باز شدن صفحه محصول
            e.preventDefault();

            const card = btn.closest(".product-card");
            if (!card) return;

            const product = getProductFromCard(card);
            const icon = btn.querySelector("i");
            const alreadyInWish = wishItems.some((i) => i.id === product.id);

            if (alreadyInWish) {
                wishItems = wishItems.filter((i) => i.id !== product.id);
                btn.classList.remove("active");
                if (icon) icon.className = "ti ti-heart";
            } else {
                wishItems.push(product);
                btn.classList.add("active");
                if (icon) icon.className = "ti ti-heart-filled";
            }

            /** آپدیت badge علاقه‌مندی در header */
            const wishBadge = document.getElementById("wishlistBadge");
            if (wishBadge) wishBadge.textContent = fa(wishItems.length);
        });
    });

    /* ================================================================
       6. CART & WISHLIST MODAL — پنل‌های کشویی header
    ================================================================ */
    (function () {
        /** داده‌های نمونه سبد خرید */
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

        /** باز/بسته کردن modal */
        function openModal(modal, overlay) {
            modal.classList.add("open");
            overlay.classList.add("open");
            document.body.style.overflow = "hidden";
        }
        function closeModal(modal, overlay) {
            modal.classList.remove("open");
            overlay.classList.remove("open");
            document.body.style.overflow = "";
        }

        /** رندر سبد خرید modal */
        function renderCart() {
            const body = document.getElementById("cartBody");
            const totalEl = document.getElementById("cartTotal");
            const badge = document.getElementById("cartBadge");
            if (!body) return;

            const totalQty = cartItems.reduce((sum, i) => sum + i.qty, 0);
            if (badge) badge.textContent = fa(totalQty);

            if (!cartItems.length) {
                body.innerHTML = `<div class="gm-empty"><i class="ti ti-shopping-bag"></i><p>سبد خرید شما خالی است</p></div>`;
                if (totalEl) totalEl.innerHTML = "";
                return;
            }

            const total = cartItems.reduce(
                (sum, i) => sum + i.price * i.qty,
                0,
            );
            if (totalEl)
                totalEl.innerHTML = `<span>جمع کل:</span><strong>${fmt(total)} تومان</strong>`;

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

            body.querySelectorAll(".gm-item__del").forEach((btn) => {
                btn.addEventListener("click", () => {
                    cartItems = cartItems.filter(
                        (i) => i.id !== btn.dataset.id,
                    );
                    renderCart();
                });
            });

            body.querySelectorAll(".gm-qty-btn").forEach((btn) => {
                btn.addEventListener("click", () => {
                    const item = cartItems.find((i) => i.id === btn.dataset.id);
                    if (!item) return;
                    if (btn.dataset.action === "inc") {
                        item.qty++;
                    } else if (item.qty > 1) {
                        item.qty--;
                    } else {
                        cartItems = cartItems.filter((i) => i.id !== item.id);
                    }
                    renderCart();
                });
            });
        }

        /** رندر علاقه‌مندی‌ها modal */
        function renderWishlist() {
            const body = document.getElementById("wishlistBody");
            const badge = document.getElementById("wishlistBadge");
            if (!body) return;

            if (badge) badge.textContent = fa(wishItems.length);

            if (!wishItems.length) {
                body.innerHTML = `<div class="gm-empty"><i class="ti ti-heart"></i><p>لیست علاقه‌مندی‌ها خالی است</p></div>`;
                return;
            }

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

            /** helper: برگشت آیکون fav کارت به حالت خط‌دار */
            function resetFavBtn(id) {
                const btn = document.querySelector(
                    `.product-card[data-id="${id}"] .product-card__fav`,
                );
                if (btn) {
                    btn.classList.remove("active");
                    const icon = btn.querySelector("i");
                    if (icon) icon.className = "ti ti-heart";
                }
            }

            body.querySelectorAll(".gm-item__del").forEach((btn) => {
                btn.addEventListener("click", () => {
                    wishItems = wishItems.filter(
                        (i) => i.id !== btn.dataset.id,
                    );
                    resetFavBtn(btn.dataset.id);
                    renderWishlist();
                });
            });

            body.querySelectorAll(".gm-add-cart-btn").forEach((btn) => {
                btn.addEventListener("click", () => {
                    const item = wishItems.find((i) => i.id === btn.dataset.id);
                    if (!item) return;
                    const existing = cartItems.find((i) => i.id === item.id);
                    if (existing) {
                        existing.qty++;
                    } else {
                        cartItems.push({ ...item, qty: 1 });
                    }
                    wishItems = wishItems.filter((i) => i.id !== item.id);
                    resetFavBtn(item.id);
                    renderWishlist();
                    renderCart();
                });
            });
        }

        const cartModal = document.getElementById("cartModal");
        const cartOverlay = document.getElementById("cartOverlay");
        const wishModal = document.getElementById("wishlistModal");
        const wishOverlay = document.getElementById("wishlistOverlay");

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

        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") {
                closeModal(cartModal, cartOverlay);
                closeModal(wishModal, wishOverlay);
            }
        });
    })();

    /* ================================================================
       7. CART PAGE — صفحه سبد خرید (فقط اگر المان‌های آن موجود باشد)
    ================================================================ */
    if (!document.getElementById("cartItemsList")) return; // اجرا نشود مگر در cart.html

    /** داده‌های محصولات سبد در صفحه cart.html */
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

    const suggested = [
        {
            id: "s1",
            title: "پاوربانک انکر ۲۰۰۰۰ مگاپاور",
            cat: "پاوربانک",
            price: 890000,
            oldPrice: 1100000,
            rating: 4.7,
            reviews: 284,
            img: "https://images.unsplash.com/photo-1609091839311-d5365f9ff1c5?q=80&w=300&auto=format&fit=crop",
        },
        {
            id: "s2",
            title: "کیس شفاف مگ‌سیف آیفون ۱۵ پرو",
            cat: "قاب و محافظ",
            price: 145000,
            oldPrice: 190000,
            rating: 4.5,
            reviews: 128,
            img: "https://images.unsplash.com/photo-1601784551446-20c9e07cdbdb?q=80&w=300&auto=format&fit=crop",
        },
        {
            id: "s3",
            title: "شارژر دیواری ۶۵ وات گرین لاین",
            cat: "شارژر و کابل",
            price: 310000,
            oldPrice: 380000,
            rating: 4.8,
            reviews: 412,
            img: "https://images.unsplash.com/photo-1585771724684-38269d6639fd?q=80&w=300&auto=format&fit=crop",
        },
        {
            id: "s4",
            title: "گلس سرامیکی حریم خصوصی ۹D",
            cat: "محافظ صفحه",
            price: 85000,
            oldPrice: 120000,
            rating: 4.3,
            reviews: 97,
            img: "https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?q=80&w=300&auto=format&fit=crop",
        },
    ];

    const COUPONS = { WINTER2026: 10, GHABOS10: 10, WELCOME: 5 };
    let appliedCoupon = null;
    const FREE_SHIP_THRESHOLD = 5000000;

    function renderPageCart() {
        const list = document.getElementById("cartItemsList");
        if (!list) return;

        const totalQty = pageCartItems.reduce((s, i) => s + i.qty, 0);
        const badge = document.getElementById("cartBadge");
        const mobileBadge = document.querySelector(".bottom-nav .badge");
        const countEl = document.getElementById("pageCartCount");
        const summaryQty = document.getElementById("summaryQty");

        if (badge) badge.textContent = fa(totalQty);
        if (mobileBadge) mobileBadge.textContent = fa(totalQty);
        if (countEl) countEl.textContent = fa(totalQty) + " محصول";
        if (summaryQty) summaryQty.textContent = fa(totalQty);

        /** حالت سبد خالی */
        if (!pageCartItems.length) {
            if (countEl) countEl.textContent = "خالی";
            document.getElementById("cartLayout").innerHTML = `
                <div class="cart-empty-wrap">
                    <div class="cart-empty">
                        <div class="cart-empty__icon-wrap">
                            <div class="cart-empty__dot"></div>
                            <div class="cart-empty__dot"></div>
                            <div class="cart-empty__dot"></div>
                            <div class="cart-empty__icon-bg"><i class="ti ti-shopping-bag"></i></div>
                        </div>
                        <h3>سبد خرید شما خالی است</h3>
                        <p>هنوز هیچ محصولی به سبد خریدتان اضافه نکرده‌اید.<br>همین حالا خرید را شروع کنید و از تخفیف‌های ویژه بهره‌مند شوید!</p>
                        <div class="cart-empty__actions">
                            <a href="index.html" class="cart-empty__btn"><i class="ti ti-shopping"></i> رفتن به فروشگاه</a>
                            <a href="wishlist.html" class="cart-empty__btn--outline"><i class="ti ti-heart"></i> علاقه‌مندی‌ها</a>
                        </div>
                        <div class="cart-empty__perks">
                            <div class="cart-empty__perk"><i class="ti ti-truck-delivery"></i><span>ارسال رایگان<br>بالای ۵ میلیون</span></div>
                            <div class="cart-empty__perk"><i class="ti ti-shield-check"></i><span>پرداخت<br>۱۰۰٪ امن</span></div>
                            <div class="cart-empty__perk"><i class="ti ti-refresh"></i><span>۷ روز ضمانت<br>بازگشت وجه</span></div>
                            <div class="cart-empty__perk"><i class="ti ti-certificate"></i><span>گارانتی<br>اصالت کالا</span></div>
                        </div>
                    </div>
                </div>`;
            return;
        }

        list.innerHTML = pageCartItems
            .map((item) => {
                const discPct = item.oldPrice
                    ? Math.round((1 - item.price / item.oldPrice) * 100)
                    : 0;
                return `
                <div class="cart-item" data-id="${item.id}">
                    <img class="cart-item__img" src="${item.img}" alt="${item.title}" loading="lazy"/>
                    <div class="cart-item__body">
                        <span class="cart-item__cat">${item.cat}</span>
                        <p class="cart-item__title"><a href="product.html?id=${item.id}">${item.title}</a></p>
                        <div class="cart-item__attrs">
                            ${item.badge ? `<span class="cart-item__badge">${item.badge}</span>` : ""}
                            <span class="cart-item__badge green"><i class="ti ti-shield-check" style="font-size:11px"></i> ${item.guarantee}</span>
                            ${item.stock <= 5 ? `<span class="cart-item__badge" style="color:var(--c-amber);border-color:rgba(245,166,35,.3);background:rgba(245,166,35,.08)">فقط ${fa(item.stock)} عدد باقی‌مانده</span>` : ""}
                        </div>
                        <div class="cart-item__meta">
                            <div class="cart-item__qty">
                                <button class="qty-btn dec" data-id="${item.id}" aria-label="کاهش"><i class="ti ti-minus"></i></button>
                                <span class="qty-val">${fa(item.qty)}</span>
                                <button class="qty-btn inc" data-id="${item.id}" aria-label="افزایش"><i class="ti ti-plus"></i></button>
                            </div>
                            <div class="cart-item__prices">
                                ${item.oldPrice ? `<span class="cart-item__old">${fmt(item.oldPrice)} تومان</span>` : ""}
                                <span class="cart-item__new">${fmt(item.price)} <small>تومان</small></span>
                                ${discPct ? `<span class="cart-item__disc">${fa(discPct)}٪ تخفیف</span>` : ""}
                            </div>
                        </div>
                    </div>
                    <button class="cart-item__del" data-id="${item.id}" aria-label="حذف از سبد"><i class="ti ti-trash"></i></button>
                </div>`;
            })
            .join("");

        list.querySelectorAll(".cart-item__del").forEach((btn) => {
            btn.addEventListener("click", () => {
                pageCartItems = pageCartItems.filter(
                    (i) => i.id !== btn.dataset.id,
                );
                renderPageCart();
            });
        });

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

        /** محاسبه خلاصه سفارش */
        const origTotal = pageCartItems.reduce(
            (s, i) => s + (i.oldPrice || i.price) * i.qty,
            0,
        );
        const discTotal = pageCartItems.reduce(
            (s, i) => s + i.price * i.qty,
            0,
        );
        const saved = origTotal - discTotal;
        let couponAmt = 0;

        const couponRow = document.getElementById("couponRow");
        const summaryCoupon = document.getElementById("summaryCoupon");
        if (appliedCoupon && COUPONS[appliedCoupon]) {
            couponAmt = Math.round((discTotal * COUPONS[appliedCoupon]) / 100);
            if (couponRow) couponRow.style.display = "flex";
            if (summaryCoupon)
                summaryCoupon.textContent = "−" + fmt(couponAmt) + " تومان";
        } else {
            if (couponRow) couponRow.style.display = "none";
        }

        const finalTotal = discTotal - couponAmt;
        const remaining = FREE_SHIP_THRESHOLD - finalTotal;
        const progress = Math.min(
            100,
            Math.round((finalTotal / FREE_SHIP_THRESHOLD) * 100),
        );

        const summaryOriginal = document.getElementById("summaryOriginal");
        const summaryDiscount = document.getElementById("summaryDiscount");
        const summaryTotal = document.getElementById("summaryTotal");
        const shippingMsg = document.getElementById("shippingMsg");
        const shippingBar = document.getElementById("shippingBar");
        const summaryShipping = document.getElementById("summaryShipping");

        if (summaryOriginal)
            summaryOriginal.textContent = fmt(origTotal) + " تومان";
        if (summaryDiscount)
            summaryDiscount.textContent = "−" + fmt(saved) + " تومان";
        if (summaryTotal)
            summaryTotal.innerHTML = fmt(finalTotal) + " <small>تومان</small>";

        if (remaining <= 0) {
            if (shippingMsg)
                shippingMsg.textContent = "🎉 ارسال این سفارش رایگان است!";
            if (shippingBar) shippingBar.style.width = "100%";
            if (summaryShipping) summaryShipping.textContent = "رایگان";
        } else {
            if (shippingMsg)
                shippingMsg.textContent =
                    "برای ارسال رایگان " +
                    fmt(remaining) +
                    " تومان دیگر خرید کنید";
            if (shippingBar) shippingBar.style.width = progress + "%";
            if (summaryShipping)
                summaryShipping.innerHTML =
                    '<span style="font-size:12px;color:var(--c-muted)">محاسبه در مرحله بعد</span>';
        }
    }

    document.getElementById("clearCartBtn")?.addEventListener("click", () => {
        if (confirm("آیا می‌خواهید همه محصولات را از سبد خرید حذف کنید؟")) {
            pageCartItems = [];
            renderPageCart();
        }
    });

    /** کد تخفیف */
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
            couponInput?.parentElement.after(el);
        }
        el.style.color =
            {
                green: "var(--c-green)",
                red: "var(--c-red)",
                amber: "var(--c-amber)",
            }[type] || "var(--c-muted)";
        el.textContent = msg;
        setTimeout(() => {
            el.style.opacity = "0";
        }, 3000);
        setTimeout(() => {
            el.style.opacity = "1";
        }, 0);
    }

    /** رندر محصولات پیشنهادی */
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
                        <img src="${p.img}" alt="${p.title}" loading="lazy"/>
                        <span class="product-card__badge">${fa(discPct)}٪</span>
                        <button class="product-card__fav" aria-label="افزودن به علاقه‌مندی"><i class="ti ti-heart"></i></button>
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

    renderPageCart();
    renderSuggested();

    /* ================================================================
       9. NEWSLETTER
    ================================================================ */
    const newsletterForm = document.getElementById("newsletterForm");
    if (newsletterForm) {
        newsletterForm.addEventListener("submit", (e) => {
            e.preventDefault();
            const email = newsletterForm
                .querySelector("input[type=email]")
                ?.value.trim();
            if (!email || !email.includes("@")) {
                alert("ایمیل معتبر وارد کنید");
                return;
            }
            alert("عضویت با موفقیت انجام شد");
        });
    }

    /* ================================================================
       10. MOBILE SCROLL — اسکرول افقی گریدهای موبایل
    ================================================================ */
    const scrollTargets =
        ".products-grid,.latest-products,.new-products,.brands,.cats";
    document.querySelectorAll(scrollTargets).forEach((el) => {
        const wrapper = document.createElement("div");
        wrapper.className = "mobile-scroll-wrapper";
        el.parentNode.insertBefore(wrapper, el);
        wrapper.appendChild(el);

        const prev = document.createElement("button");
        prev.className = "scroll-arrow prev";
        prev.innerHTML = "❯";

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
}); // end DOMContentLoaded

/* ================================================================
   8. LOGIN / OTP — فرم ورود، ثبت‌نام، کد تأیید
   این بخش مستقیماً اجرا می‌شود (نه داخل DOMContentLoaded)
   چون المان‌های آن فقط در login.html هستند
================================================================ */

/** سوئیچ بین تب‌های ورود و ثبت‌نام */
document.querySelectorAll("[data-target]").forEach((el) => {
    el.addEventListener("click", () => {
        const target = el.getAttribute("data-target");
        document
            .querySelectorAll(".auth-tab")
            .forEach((t) => t.classList.remove("active"));
        document
            .querySelectorAll(".auth-form")
            .forEach((f) => f.classList.remove("active"));
        document
            .querySelector(`.auth-tab[data-target="${target}"]`)
            ?.classList.add("active");
        document.getElementById(target)?.classList.add("active");
    });
});

/** نمایش/پنهان‌سازی رمز عبور */
document.querySelectorAll(".toggle-pass").forEach((btn) => {
    btn.addEventListener("click", () => {
        const input = document.getElementById(btn.dataset.for);
        if (!input) return;
        const icon = btn.querySelector("i");
        if (input.type === "password") {
            input.type = "text";
            if (icon) icon.className = "ti ti-eye-off";
        } else {
            input.type = "password";
            if (icon) icon.className = "ti ti-eye";
        }
    });
});

/** OTP — متغیرها و توابع */
const _authCard = document.querySelector(".auth-card");
if (_authCard) {
    const otpBoxes = Array.from(document.querySelectorAll(".otp-box"));
    const otpTimerEl = document.getElementById("otpTimer");
    const otpResendBtn = document.getElementById("otpResend");

    let otpContext = "register";
    let otpTimerInterval = null;
    const OTP_DURATION = 120;

    function showForm(id) {
        document
            .querySelectorAll(".auth-form")
            .forEach((f) => f.classList.remove("active"));
        document.getElementById(id)?.classList.add("active");
    }

    function setOtpBoxesDisabled(disabled) {
        otpBoxes.forEach((b) => {
            b.disabled = disabled;
            b.style.opacity = disabled ? "0.45" : "";
            b.style.cursor = disabled ? "not-allowed" : "";
            if (disabled) b.style.borderColor = "";
        });
    }

    function startOtpTimer() {
        clearInterval(otpTimerInterval);
        let remaining = OTP_DURATION;
        otpResendBtn.disabled = true;
        setOtpBoxesDisabled(false);

        const render = () => {
            const m = Math.floor(remaining / 60);
            const s = remaining % 60;
            otpTimerEl.innerHTML = `<i class="ti ti-clock"></i> ${fa(String(m).padStart(2, "0"))}:${fa(String(s).padStart(2, "0"))}`;
            otpTimerEl.classList.remove("warn", "danger");
            if (remaining <= 20) otpTimerEl.classList.add("danger");
            else if (remaining <= 60) otpTimerEl.classList.add("warn");
        };
        render();

        otpTimerInterval = setInterval(() => {
            remaining--;
            render();
            if (remaining <= 0) {
                clearInterval(otpTimerInterval);
                otpResendBtn.disabled = false;
                setOtpBoxesDisabled(true);
                otpTimerEl.innerHTML = `<i class="ti ti-clock"></i> کد منقضی شد`;
                otpTimerEl.classList.add("danger");
            }
        }, 1000);
    }

    function resetOtpBoxes() {
        otpBoxes.forEach((b) => {
            b.value = "";
            b.disabled = false;
            b.style.opacity = "";
            b.style.cursor = "";
            b.classList.remove("filled");
            b.style.borderColor = "";
        });
    }

    function goToOtp(phone, context) {
        const phoneClean = (phone || "").trim();
        if (phoneClean.length < 10) {
            const input = document.getElementById(
                context === "register" ? "reg-phone" : "login-phone",
            );
            if (input) {
                input.focus();
                input.style.borderColor = "var(--c-red)";
                setTimeout(() => {
                    input.style.borderColor = "";
                }, 1200);
            }
            return;
        }
        otpContext = context;
        const phoneEl = document.getElementById("otpPhoneNumber");
        if (phoneEl) phoneEl.textContent = fa(phoneClean);
        _authCard.classList.add("no-tabs");
        showForm("otp");
        resetOtpBoxes();
        otpBoxes[0]?.focus();
        startOtpTimer();
    }

    function goBackFromOtp() {
        clearInterval(otpTimerInterval);
        _authCard.classList.remove("no-tabs");
        document
            .querySelectorAll(".auth-tab")
            .forEach((t) => t.classList.remove("active"));
        const target = otpContext === "register" ? "register" : "login";
        document
            .querySelector(`.auth-tab[data-target="${target}"]`)
            ?.classList.add("active");
        showForm(target);
    }

    /** اتصال رویدادها به دکمه‌های فرم لاگین */
    document
        .getElementById("registerSubmitBtn")
        ?.addEventListener("click", () =>
            goToOtp(document.getElementById("reg-phone")?.value, "register"),
        );
    document
        .getElementById("registerOtpBtn")
        ?.addEventListener("click", () =>
            goToOtp(document.getElementById("reg-phone")?.value, "register"),
        );
    document
        .getElementById("loginOtpBtn")
        ?.addEventListener("click", () =>
            goToOtp(document.getElementById("login-phone")?.value, "login"),
        );
    document
        .getElementById("otpEditBtn")
        ?.addEventListener("click", goBackFromOtp);

    otpResendBtn?.addEventListener("click", () => {
        if (otpResendBtn.disabled) return;
        resetOtpBoxes();
        otpBoxes[0]?.focus();
        startOtpTimer();
    });

    /** رفتار inputهای OTP: پیشروی خودکار، Backspace، Paste */
    otpBoxes.forEach((box, idx) => {
        box.addEventListener("input", () => {
            const val = box.value.replace(/[^0-9۰-۹]/g, "").slice(-1);
            box.value = val;
            box.classList.toggle("filled", !!val);
            box.style.borderColor = "";
            if (val && idx < otpBoxes.length - 1) otpBoxes[idx + 1].focus();
        });

        box.addEventListener("keydown", (e) => {
            if (e.key === "Backspace" && !box.value && idx > 0) {
                otpBoxes[idx - 1].focus();
                otpBoxes[idx - 1].value = "";
                otpBoxes[idx - 1].classList.remove("filled");
            }
        });

        box.addEventListener("paste", (e) => {
            e.preventDefault();
            const text = (e.clipboardData || window.clipboardData)
                .getData("text")
                .replace(/[^0-9۰-۹]/g, "");
            text.split("").forEach((ch, i) => {
                if (otpBoxes[idx + i]) {
                    otpBoxes[idx + i].value = ch;
                    otpBoxes[idx + i].classList.add("filled");
                }
            });
            otpBoxes[Math.min(idx + text.length, otpBoxes.length - 1)].focus();
        });
    });

    /** ارسال فرم OTP */
    document.getElementById("otp")?.addEventListener("submit", (e) => {
        e.preventDefault();
        const allFilled = otpBoxes.every((b) => b.value !== "");
        if (!allFilled) {
            otpBoxes.forEach((b) => {
                if (!b.value) b.style.borderColor = "var(--c-red)";
            });
            return;
        }
        clearInterval(otpTimerInterval);
        _authCard.classList.add("no-tabs");

        const title = document.getElementById("successTitle");
        const desc = document.getElementById("successDesc");
        if (otpContext === "register") {
            if (title) title.textContent = "عضویت شما با موفقیت تکمیل شد!";
            if (desc)
                desc.textContent =
                    "به خانواده غباس خوش آمدید 🎉 اکنون می‌توانید خریدتان را شروع کنید.";
        } else {
            if (title) title.textContent = "ورود با موفقیت انجام شد!";
            if (desc) desc.textContent = "خوشحالیم که دوباره می‌بینیمت 👋";
        }
        showForm("success");
    });
}
